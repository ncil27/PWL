<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ARSA</title>
    <link rel="icon" href="{{ asset('templates/assets/images/logo/logo_bulet.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #e0e7ff, #f1f5ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: white;
            border-radius: 1rem;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.1);
            padding: 3rem 2rem;
            width: 100%;
            max-width: 500px;
        }

        .login-box h2 {
            font-weight: 800;
            color: #3f51b5;
        }

        .btn-login {
            width: 100%;
            border-radius: 2rem;
        }

        .logo {
            width: 80px;
            margin-bottom: 1rem;
        }
        .form-group{
            display: flex;
            flex-wrap: wrap 
        }
    </style>
</head>

<body>

    <div class="login-box text-center">
        <img src="{{ asset('templates/assets/images/logo/logo_bulet.png') }}" alt="Logo ARSA" class="logo">
        <h2>Login</h2>
        <p class="mb-4 text-muted">Academic Request & Submission App</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <!-- Email -->
            <div class="form-group mandatory mt-3">
                <label for="email" class="card-title">Email</label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Masukkan Email Anda" name="email" value="{{ old('email') }}" required autofocus />

                @error('email')
                    <div class="invalid-feedback mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group mandatory mt-4">
                <label for="password" class="card-title">Password</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" required autocomplete="current-password" />

                @error('password')
                    <div class="invalid-feedback mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-login mt-4">Login</button>
        </form>
    </div>


    <script src="{{ asset('templates/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('templates/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('templates/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('templates/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('templates/assets/js/main.js') }}"></script>
</body>

</html>
