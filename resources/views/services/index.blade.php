@extends('layouts.admin.app')

@section('title', 'Manage Services')
@section('page-title', 'Manage Services')

{{-- @section('header')
    <h2 class="font-display text-2xl font-extrabold text-[#1e3a5f]">
        Welcome back, {{ Auth::user()->name }} 👋
    </h2>
@endsection --}}

@section('content')

    <div class="flex items-center justify-between mb-4">
        <div>
            <h4 class="mb-0 font-bold" style="color:#1e3a5f;">Services</h4>
            <p class="text-gray-500 mb-0 text-sm">Manage available services and pricing.</p>
        </div>
        <a href="{{ route('admin.services.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
            </svg>
            <span>Add Service</span>
        </a>
    </div>

    {{--SEARCH FORM--}}
    <div class="mb-4 rounded-xl bg-white shadow-sm border border-gray-200">
        <div class="px-4 py-3">
            <form method="GET" action="{{ route('admin.services.index') }}"
                class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                {{-- Search --}}
                <div class="md:col-span-8">
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
                            placeholder="Service name, description..."
                            class="w-full border-0 px-2 py-2 text-sm focus:ring-0 focus:outline-none"
                        >
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="md:col-span-4 flex gap-2">
                    <button type="submit"
                            class="rounded-lg border border-indigo-600 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50 transition">
                        Search
                    </button>

                    @if (request()->has('search'))
                        <a href="{{ route('admin.services.index') }}"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    {{--TABLE OF SERVICES--}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-12 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            #
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Service Name
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Description
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Base Price
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white" id="service-table">
                    @forelse ($services as $service)
                        <tr class="hover:bg-gray-50 transition" data-service-id="{{ $service->id }}">

                            {{-- Number --}}
                            <td class="px-4 py-4 text-sm text-gray-500">
                                {{ ($services->currentPage() - 1) * $services->perPage() + $loop->iteration }}
                            </td>

                            {{-- Service Name --}}
                            <td class="px-4 py-4">
                                <div class="font-semibold text-slate-800">
                                    {{ $service->service_name }}
                                </div>
                            </td>

                            {{-- Description --}}
                            <td class="px-4 py-4 text-sm text-gray-600 max-w-xs">
                                <p class="line-clamp-2">
                                    {{ $service->description ?? '—' }}
                                </p>
                            </td>

                            {{-- Base Price --}}
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                    ₱{{ number_format($service->base_price, 2) }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-4">
                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('admin.services.edit', $service) }}"
                                    class="inline-flex items-center gap-1 rounded-lg border border-indigo-300 px-3 py-1.5 text-sm font-medium text-indigo-600 hover:bg-indigo-50 transition-colors">
                                        Edit
                                    </a>

                                    {{-- Delete Button --}}
                                    <button type="button"
                                            onclick="openDeleteModal('{{ $service->id }}', '{{ addslashes($service->service_name) }}')"
                                            class="inline-flex items-center gap-1 rounded-lg border border-red-300 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                                        Delete
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">

                                <div class="px-6 py-16 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="mx-auto mb-4 h-12 w-12 text-gray-300"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l5.653-4.655m5.8-5.8 2.998 2.998a1.5 1.5 0 0 1 0 2.122l-.879.879a1.5 1.5 0 0 1-2.122 0l-2.998-2.998m5.8-5.8L17.25 3A2.652 2.652 0 0 0 13.5 6.75l-1.42 1.42m5.8-5.8-2.122 2.12" />
                                    </svg>

                                    <h3 class="text-sm font-semibold text-gray-700">No services found</h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ request()->has('search')
                                            ? 'Try adjusting your search.'
                                            : 'Get started by adding your first service.' }}
                                    </p>

                                    @unless(request()->has('search'))
                                        <a href="{{ route('admin.services.create') }}"
                                        class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                            Add Service
                                        </a>
                                    @endunless
                                </div>

                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="service-empty" hidden>
                <div class="px-6 py-16 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mx-auto mb-4 h-12 w-12 text-gray-300"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l5.653-4.655m5.8-5.8 2.998 2.998a1.5 1.5 0 0 1 0 2.122l-.879.879a1.5 1.5 0 0 1-2.122 0l-2.998-2.998m5.8-5.8L17.25 3A2.652 2.652 0 0 0 13.5 6.75l-1.42 1.42m5.8-5.8-2.122 2.12" />
                    </svg>

                    <h3 class="text-sm font-semibold text-gray-700">No services found</h3>

                    <p class="mt-1 text-sm text-gray-500">
                        {{ request()->has('search')
                            ? 'Try adjusting your search.'
                            : 'Get started by adding your first service.' }}
                    </p>

                    @unless(request()->has('search'))
                        <a href="{{ route('admin.services.create') }}"
                        class="mt-4 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                            Add Service
                        </a>
                    @endunless
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($services->hasPages())
            <div class="flex flex-col gap-3 border-t border-gray-200 px-4 py-3 md:flex-row md:items-center md:justify-between">
                <p class="text-sm text-gray-500">
                    Showing {{ $services->firstItem() }}–{{ $services->lastItem() }}
                    of {{ $services->total() }} services
                </p>

                {{ $services->links() }}
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm"
        role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">
    
        <div class="mx-4 w-full max-w-md rounded-2xl bg-white p-6 shadow-xl"
            onclick="event.stopPropagation()">
    
            {{-- Icon --}}
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
            </div>
    
            {{-- Content --}}
            <h2 id="deleteModalTitle" class="text-lg font-semibold text-gray-900">Delete Service</h2>
            <p class="mt-1 text-sm text-gray-500">
                Are you sure you want to delete
                <span id="deleteServiceName" class="font-medium text-gray-700"></span>?
                This action cannot be undone.
            </p>
    
            {{-- Actions --}}
            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50">
                    Cancel
                </button>
                <button type="button"
                        id="confirmDeleteBtn"
                        onclick="confirmDelete()"
                        class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-60">
                    <svg id="deleteSpinner" class="hidden h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    <span id="deleteButtonText">Delete</span>
                </button>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
<script>
    let deleteServiceId = null;
 
    function openDeleteModal(id, name) {
        deleteServiceId = id;
        document.getElementById('deleteServiceName').textContent = name;
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }
 
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
        deleteServiceId = null;
        setDeleteLoading(false);
    }
 
    function setDeleteLoading(loading) {
        const btn    = document.getElementById('confirmDeleteBtn');
        const spinner = document.getElementById('deleteSpinner');
        const text   = document.getElementById('deleteButtonText');
 
        btn.disabled = loading;
        spinner.classList.toggle('hidden', !loading);
        text.textContent = loading ? 'Deleting...' : 'Delete';
    }
 
    async function confirmDelete() {
        if (!deleteServiceId) return;
 
        const url = `{{ route('admin.services.destroy', ['service' => ':id']) }}`.replace(':id', deleteServiceId);
 
        setDeleteLoading(true);
 
        try {
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            });
 
            const data = await response.json();
 
            if (response.ok) {
                const id = deleteServiceId;
                closeDeleteModal();
 
                const row = document.querySelector(`[data-service-id="${id}"]`);
                if (row) {
                    row.remove();
 
                    const remainingRows = document.querySelectorAll('[data-service-id]');
 
                    if (remainingRows.length === 0) {
                        document.getElementById('service-table').classList.add('hidden');
                        document.getElementById('service-empty').removeAttribute('hidden');
                    }
                }
            } else {
                alert(data.message ?? 'Failed to delete service. Please try again.');
                setDeleteLoading(false);
            }
        } catch (err) {
            console.error(err);
            alert('An unexpected error occurred. Please try again.');
            setDeleteLoading(false);
        }
    }
 
    // Close on backdrop click
    document.getElementById('deleteModal').addEventListener('click', closeDeleteModal);
 
    // Close on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
@endpush

