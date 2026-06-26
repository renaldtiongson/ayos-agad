<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('service_name', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->paginate(10);

        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'base_price'   => ['required', 'numeric', 'min:0'],
        ]);

        Service::create($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service added successfully.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_name' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
            'base_price'   => ['required', 'numeric', 'min:0'],
        ]);

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return true;
    }
    
}