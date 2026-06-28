<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TechnicianController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (!auth()->check()) {
        return view('welcome');
    }

    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin_dashboard');
    }

    if ($user->hasRole('technician')) {
        return redirect()->route('technician_dashboard');
    }

    if ($user->hasRole('customer')) {
        return redirect()->route('customer_dashboard');
    }

    return view('welcome'); // fallback if no role matches
})->name('home');


//CUSTOMER ROUTES
Route::middleware(['auth','isCustomer'])->group(function () {
    Route::get('/customer/dashboard', function () {return view('dashboard.customer_dashboard');})->name('customer_dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//ADMIN ROUTES
Route::middleware(['auth','isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {return view('dashboard.admin_dashboard');})->name('admin_dashboard');

    Route::get('/admin/manage-technicians', [TechnicianController::class, 'index'])->name('admin.technicians.index');
    Route::get('/admin/manage-technicians/create', [TechnicianController::class, 'create'])->name('admin.technicians.create');
    Route::post('/admin/manage-technicians/store', [TechnicianController::class, 'store'])->name('admin.technicians.store');
    Route::get('/admin/manage-technicians/{technician}/edit', [TechnicianController::class, 'edit'])->name('admin.technicians.edit');
    Route::put('/admin/manage-technicians/{technician}/update', [TechnicianController::class, 'update'])->name('admin.technicians.update');
    Route::delete('/admin/manage-technicians/{technician}/delete', [TechnicianController::class, 'destroy'])->name('admin.technicians.destroy');

    Route::get('/admin/manage-services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/admin/manage-services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/admin/manage-services/store', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/admin/manage-services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/admin/manage-services/{service}/update', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/admin/manage-services/{service}/delete', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    Route::get('/t/{technician}', [TechnicianController::class, 'show'])->name('technicians.show'); //username to be used in the future for public profile.

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//TECHNICIAN ROUTES
Route::middleware(['auth','isTechnician'])->group(function () {
    Route::get('/technician/dashboard', function () {return view('dashboard.technician_dashboard');})->name('technician_dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
