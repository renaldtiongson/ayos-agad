@extends('layouts.admin.app')

@section('title', 'Manage Technicians')
@section('page-title', 'Manage Technicians')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/technician-profile.css') }}">
@endpush


@section('content')


<div class="tech-profile">

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <div class="tp-header">
        <div class="tp-avatar">
            {{ strtoupper(substr($technician->user->name, 0, 1)) }}
        </div>

        <div class="tp-identity">
            <div class="tp-name-row">
                <h1 class="tp-name">{{ $technician->user->name }}</h1>

                @php
                    $status = $technician->status;
                @endphp

                <span class="tp-status-badge tp-status-{{ $status }}" title="{{ ucfirst($status) }}">
                    <span class="tp-status-dot"></span>
                    {{ ucfirst($status) }}
                </span>
            </div>

            <p class="tp-location">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0Z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                {{ $technician->location }}
            </p>
        </div>
    </div>

    <div class="tp-divider"></div>

    {{-- ── Services ────────────────────────────────────────────── --}}
    <section class="tp-section" aria-labelledby="services-heading">
        <h2 class="tp-section-label" id="services-heading">Services</h2>

        @if ($technician->services->isEmpty())
            <p class="tp-empty-text">No services added yet.</p>
        @else
            <div class="tp-services">
                @foreach ($technician->services as $service)
                    <span class="tp-service-tag">{{ $service->service_name }}</span>
                @endforeach
            </div>
        @endif
    </section>

    <div class="tp-divider"></div>

    {{-- ── Ratings ─────────────────────────────────────────────── --}}
    <section class="tp-section" aria-labelledby="ratings-heading">
        <h2 class="tp-section-label" id="ratings-heading">Ratings</h2>

        <div class="tp-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.5"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <p class="tp-placeholder-text">Ratings coming soon.</p>
        </div>
    </section>

    <div class="tp-divider"></div>

    {{-- ── Availability ─────────────────────────────────────────── --}}
    <section class="tp-section" aria-labelledby="availability-heading">
        <h2 class="tp-section-label" id="availability-heading">Availability</h2>

        <div class="tp-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.5"
                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <path d="M16 2v4M8 2v4M3 10h18"/>
            </svg>
            <p class="tp-placeholder-text">Availability calendar coming soon.</p>
        </div>
    </section>

</div>

@endsection
