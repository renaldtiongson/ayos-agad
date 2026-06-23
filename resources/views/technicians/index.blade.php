@extends('layouts.admin.app')

@section('title', 'Manage Technicians')
@section('page-title', 'Manage Technicians')

{{-- @section('header')
    <h2 class="font-display text-2xl font-extrabold text-[#1e3a5f]">
        Welcome back, {{ Auth::user()->name }} 👋
    </h2>
@endsection --}}

@section('content')

    <div class="flex items-center justify-between mb-4">
        <div>
            <h4 class="mb-0 font-bold" style="color:#1e3a5f;">Technicians</h4>
            <p class="text-gray-500 mb-0 text-sm">Manage all registered technicians</p>
        </div>
        <a href="#"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            <span>Add Technician</span>
        </a>
    </div>

    {{--SEARCH AND FILTER FORM--}}
    <div class="mb-4 rounded-xl bg-white shadow-sm border border-gray-200">
        <div class="px-4 py-3">
            <form method="GET" action="{{ route('admin.technicians.index') }}"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                {{-- Search --}}
                <div class="md:col-span-5">
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Search
                    </label>

                    <div class="flex rounded-lg border border-gray-300 bg-white overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-indigo-500">
                        <span class="flex items-center px-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Name, email, specialty, location..."
                            class="w-full border-0 px-2 py-2 text-sm focus:ring-0 focus:outline-none"
                        >
                    </div>
                </div>

                {{-- Status Filter --}}
                <div class="md:col-span-3">
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="on_leave" {{ request('status') === 'on_leave' ? 'selected' : '' }}>
                            On Leave
                        </option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="md:col-span-4 flex gap-2">
                    <button type="submit"
                            class="rounded-lg border border-indigo-600 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 transition">
                        Filter
                    </button>

                    @if (request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.technicians.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    {{--TABLE OF TECHNICIANS--}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-12 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            #
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Technician
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Phone
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Specialty
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Location
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Experience
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Status
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($technicians as $technician)
                        <tr class="hover:bg-gray-50 transition">
                            
                            {{-- Number --}}
                            <td class="px-4 py-4 text-sm text-gray-500">
                                {{ ($technicians->currentPage() - 1) * $technicians->perPage() + $loop->iteration }}
                            </td>

                            {{-- Technician --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                                        {{ strtoupper(substr($technician->user->name ?? 'T', 0, 2)) }}
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            {{ $technician->user->name ?? '—' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $technician->user->email ?? '—' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Phone --}}
                            <td class="px-4 py-4 text-sm text-gray-700">
                                {{ $technician->phone }}
                            </td>

                            {{-- Specialty --}}
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-medium text-indigo-700">
                                    {{ $technician->specialty }}
                                </span>
                            </td>

                            {{-- Location --}}
                            <td class="px-4 py-4 text-sm text-gray-700">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 text-gray-400"
                                        fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                    </svg>
                                    {{ $technician->location }}
                                </div>
                            </td>

                            {{-- Experience --}}
                            <td class="px-4 py-4 text-sm text-gray-700">
                                {{ $technician->experience_years }}
                                {{ Str::plural('yr', $technician->experience_years) }}
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4">
                                @php
                                    $statusClasses = [
                                        'active'   => 'bg-green-100 text-green-700',
                                        'inactive' => 'bg-red-100 text-red-700',
                                        'on_leave' => 'bg-yellow-100 text-yellow-700',
                                    ];
                                @endphp

                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses[$technician->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst(str_replace('_', ' ', $technician->status)) }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('admin.technicians.edit', $technician) }}"
                                    class="inline-flex items-center gap-1 rounded-lg border border-indigo-300 px-3 py-1.5 text-sm font-medium text-indigo-600 hover:bg-indigo-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.technicians.destroy', $technician) }}"
                                        method="POST"
                                        onsubmit="return confirm('Delete {{ addslashes($technician->user->name ?? 'this technician') }}? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg border border-red-300 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="mx-auto mb-4 h-12 w-12 text-gray-300"
                                    fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1z"/>
                                </svg>

                                <h3 class="text-sm font-semibold text-gray-700">
                                    No technicians found
                                </h3>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ request()->hasAny(['search','status'])
                                        ? 'Try adjusting your search or filters.'
                                        : 'Get started by adding your first technician.' }}
                                </p>

                                @unless(request()->hasAny(['search','status']))
                                    <a href="#"
                                    class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                        Add Technician
                                    </a>
                                @endunless

                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($technicians->hasPages())
            <div class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 md:flex-row md:items-center md:justify-between">
                <p class="text-sm text-gray-500">
                    Showing {{ $technicians->firstItem() }}–{{ $technicians->lastItem() }}
                    of {{ $technicians->total() }} technicians
                </p>

                {{ $technicians->links() }}
            </div>
        @endif
    </div>


@endsection