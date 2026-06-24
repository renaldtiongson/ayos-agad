<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TechnicianController extends Controller
{
    public function index(Request $request)
    {
        $query = Technician::with('user');

        // Optional search/filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhere('specialty', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $technicians = $query->latest()->paginate(10)->withQueryString();

        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        // Only users not yet linked to a technician profile
        $users = User::doesntHave('technician')->orderBy('name')->get();

        return view('technicians.add', compact('users'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            // User
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],

            // Technician
            'phone' => ['required'],
            'specialty' => ['required'],
            'location' => ['required'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:available,inactive'],
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole('technician');

            Technician::create([
                'user_id' => $user->id,
                'phone' => $validated['phone'],
                'specialty' => $validated['specialty'],
                'location' => $validated['location'],
                'experience_years' => $validated['experience_years'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.technicians.index')
            ->with('success', 'Technician added successfully.');
    }

    public function edit(Technician $technician)
    {
        $technician->load('user');

        return view('technicians.edit', compact('technician'));
    }

    public function update(Request $request, Technician $technician)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($technician->user_id),
            ],

            'phone' => ['required', 'string', 'max:20'],
            'specialty' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:available,inactive'],

            'password' => ['nullable', 'min:8'],
        ]);

        DB::transaction(function () use ($validated, $technician) {

            $userData = [
                'name'  => $validated['name'],
                'email' => $validated['email'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $technician->user->update($userData);

            $technician->update([
                'phone'            => $validated['phone'],
                'specialty'        => $validated['specialty'],
                'location'         => $validated['location'],
                'experience_years' => $validated['experience_years'],
                'status'           => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.technicians.index')
            ->with('success', 'Technician updated successfully.');
    }

    public function destroy(Technician $technician)
    {
        $technician->user->delete();

        return true;
    }

    



}