@extends('layouts.customer.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('header')
    <h2 class="font-display text-2xl font-extrabold text-[#1e3a5f]">
        Welcome back, {{ Auth::user()->name }} 👋
    </h2>
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        DASHBOARD CONTENT FOR CUSTOMER GOES HERE
    </div>
@endsection