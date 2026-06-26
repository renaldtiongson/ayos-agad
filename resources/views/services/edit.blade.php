@extends('layouts.admin.app')

@section('title', 'Manage Services')
@section('page-title', 'Manage Services')

@section('content')

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center space-x-2 text-sm text-gray-500">
        <a href="{{ route('admin.services.index') }}"
           class="hover:text-indigo-600">
            Services
        </a>
        <span>/</span>
        <span class="font-medium text-gray-700">Edit Service</span>
    </nav>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="border-b border-gray-200 px-6 py-4">
            <h1 class="text-lg font-bold text-gray-900">
                Edit Service
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Update the details below for this service.
            </p>
        </div>

        {{-- Body --}}
        <div class="p-6">
            <form action="{{ route('admin.services.update', $service) }}"
                  method="POST"
                  novalidate>
                @csrf
                @method('PUT')

                {{-- Service Name + Base Price --}}
                <div class="mb-6 grid gap-4 sm:grid-cols-2">

                    <div>
                        <label for="service_name"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Service Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="service_name"
                            id="service_name"
                            value="{{ old('service_name', $service->service_name) }}"
                            placeholder="e.g. Air-con Cleaning"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('service_name') border-red-500 @enderror">

                        @error('service_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="base_price"
                               class="mb-2 block text-sm font-medium text-gray-700">
                            Base Price (₱) <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-gray-400">
                                ₱
                            </span>
                            <input
                                type="number"
                                name="base_price"
                                id="base_price"
                                min="0"
                                step="0.01"
                                value="{{ old('base_price', $service->base_price) }}"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-gray-300 py-2 pl-7 pr-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('base_price') border-red-500 @enderror">
                        </div>

                        @error('base_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label for="description"
                           class="mb-2 block text-sm font-medium text-gray-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        placeholder="Briefly describe what this service covers..."
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 border-t border-gray-200 pt-6">

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                        Update Service
                    </button>

                    <a href="{{ route('admin.services.index') }}"
                       class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                </div>

            </form>
        </div>
    </div>

@endsection
