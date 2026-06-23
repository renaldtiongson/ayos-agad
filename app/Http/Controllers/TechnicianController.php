<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;

use Illuminate\Http\Request;
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

}