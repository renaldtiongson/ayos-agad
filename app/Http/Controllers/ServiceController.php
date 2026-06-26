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
    
}