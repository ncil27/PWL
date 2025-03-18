@extends('layouts.app')

@section('title', 'Layout Horizontal - Mazer Admin Dashboard')

@section('content')
<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<nav class="main-navbar navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}"><i class="bi bi-grid-fill"></i> Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="componentsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-stack"></i> Components
                </a>
                <ul class="dropdown-menu" aria-labelledby="componentsDropdown">
                    <li><a class="dropdown-item" href="#">Alert</a></li>
                    <li><a class="dropdown-item" href="#">Badge</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Horizontal Layout</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2"><i class="iconly-boldShow"></i></div>
                            </div>
                            <div class="col-md-8 col-lg-12">
                                <h6 class="text-muted font-semibold">Profile Views</h6>
                                <h6 class="font-extrabold mb-0">112,000</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">2023 &copy; Mazer Admin</span>
    </div>
</footer>
@endsection
