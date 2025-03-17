@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="auth-left">
    <div class="auth-logo">
        <a href="{{ url('/') }}"><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
    </div>
    <h1 class="auth-title">Forgot Password</h1>
    <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email" required>
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Reset Link</button>
    </form>
</div>
@endsection
