@extends('coba-template.try-temp');
@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="dashboard-container">
        <h1>Dashboard</h1>
        <p>Selamat datang di dashboard Kai Admin.</p>

        <div class="card">
            <h3>Total Users: {{ $totalUsers }}</h3>
        </div>
    </div>
</x-app-layout>
@endsection