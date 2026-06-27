<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Technician;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TechnicianController extends Controller
{
    public function index(Request $request)
    {
        $query = Technician::with(['user', 'services']);

        // Optional search/filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhere('location', 'like', "%{$search}%")
            ->orWhereHas('services', function ($q) use ($search) {
                $q->where('service_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $technicians = $query->latest()->paginate(10)->withQueryString();

        return view('technicians.index', compact('technicians'));
    }

    public function create()
    {
        $services = Service::orderBy('service_name')->get();
        $users = User::doesntHave('technician')->orderBy('name')->get();

        return view('technicians.add', compact('users', 'services'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            // User
            'name'             => ['required', 'string', 'max:255'],
            'email'            => ['required', 'email', 'unique:users,email'],
            'password'         => ['required', 'min:8'],

            // Technician
            'phone'            => ['required'],
            'location'         => ['required'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'status'           => ['required', 'in:available,inactive'],
            'services'         => ['required', 'array', 'min:1'],
            'services.*'       => ['exists:services,id'],
        ]);

        $technician = null;

        DB::transaction(function () use ($validated, &$technician) {

            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole('technician');

            $technician = Technician::create([
                'user_id'          => $user->id,
                'phone'            => $validated['phone'],
                'location'         => $validated['location'],
                'experience_years' => $validated['experience_years'],
                'status'           => $validated['status'],
            ]);
        });

        $technician->services()->attach($validated['services']);

        return redirect()
            ->route('admin.technicians.index')
            ->with('success', 'Technician added successfully.');
    }

    public function edit(Technician $technician)
    {
        $technician->load('user', 'services');

        $services = Service::orderBy('service_name')->get();
        $selectedServices = $technician->services->pluck('id')->toArray();

        return view('technicians.edit', compact('technician', 'services', 'selectedServices'));
    }

    public function update(Request $request, Technician $technician)
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'email'            => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($technician->user_id),
            ],
            'phone'            => ['required', 'string', 'max:20'],
            'services'         => ['required', 'array', 'min:1'],
            'services.*'       => ['exists:services,id'],
            'location'         => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'status'           => ['required', 'in:available,inactive'],
            'password'         => ['nullable', 'min:8'],
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
                'location'         => $validated['location'],
                'experience_years' => $validated['experience_years'],
                'status'           => $validated['status'],
            ]);

            // sync() detaches removed and attaches new — perfect for edit
            $technician->services()->sync($validated['services']);
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