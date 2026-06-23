@extends('layouts.admin.app')

@section('title', 'Manage Technicians')
@section('page-title', 'Manage Technicians')

@section('content')
    

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center space-x-2 text-sm text-gray-500">
        <a href="{{ route('admin.technicians.index') }}"
        class="hover:text-indigo-600">
            Technicians
        </a>
        <span>/</span>
        <span class="font-medium text-gray-700">Add Technician</span>
    </nav>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="border-b border-gray-200 px-6 py-4">
            <h1 class="text-lg font-bold text-gray-900">
                Add New Technician
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Fill in the details below to register a technician.
            </p>
        </div>

        {{-- Body --}}
        <div class="p-6">
            <form action="{{ route('admin.technicians.store') }}"
                method="POST"
                novalidate>
                @csrf

                {{-- User --}}
                <div class="mb-6 grid gap-4 sm:grid-cols-2">

                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                            placeholder="John Doe">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
                            placeholder="john@example.com">

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mb-6">
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">

                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone + Experience --}}
                <div class="mb-6 grid gap-4 sm:grid-cols-2">

                    <div>
                        <label for="phone"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Phone
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            value="{{ old('phone') }}"
                            placeholder="+63 912 345 6789"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('phone') border-red-500 @enderror">

                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="experience_years"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Years of Experience
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="number"
                            name="experience_years"
                            id="experience_years"
                            min="0"
                            max="60"
                            value="{{ old('experience_years') }}"
                            placeholder="e.g. 5"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('experience_years') border-red-500 @enderror">

                        @error('experience_years')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Specialty + Location --}}
                <div class="mb-6 grid gap-4 sm:grid-cols-2">

                    <div>
                        <label for="specialty"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Specialty
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="specialty"
                            id="specialty"
                            value="{{ old('specialty') }}"
                            placeholder="e.g. HVAC, Electrician, Plumber"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('specialty') border-red-500 @enderror">

                        @error('specialty')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="location"
                            class="mb-2 block text-sm font-medium text-gray-700">
                            Location
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="location"
                            id="location"
                            value="{{ old('location') }}"
                            placeholder="e.g. Manila, PH"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror">

                        @error('location')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Status --}}
                <div class="mb-6">
                    <label class="mb-3 block text-sm font-medium text-gray-700">
                        Status
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="flex flex-wrap gap-6">

                        @foreach ([
                            'available' => 'Active',
                            'inactive' => 'Inactive'
                        ] as $value => $label)

                            <label class="inline-flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="status"
                                    value="{{ $value }}"
                                    {{ old('status', 'active') === $value ? 'checked' : '' }}
                                    class="border-gray-300 text-indigo-600 focus:ring-indigo-500">

                                <span class="text-sm text-gray-700">
                                    {{ $label }}
                                </span>
                            </label>

                        @endforeach

                    </div>

                    @error('status')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 border-t border-gray-200 pt-6">

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                        Save Technician
                    </button>

                    <a href="{{ route('admin.technicians.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                </div>

            </form>
        </div>
    </div>




@endsection