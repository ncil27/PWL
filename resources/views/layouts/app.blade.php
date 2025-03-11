<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Tambahkan link CSS dari Kai Admin -->
    <link rel="stylesheet" href="{{ asset('kai-admin/css/style.css') }}">
</head>
<body>
    <!-- Sidebar -->
    @include('partials.sidebar2')

    <!-- Navbar -->
    @include('partials.navbar')

    <div class="main-content">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Tambahkan script dari Kai Admin -->
    <script src="{{ asset('kai-admin/js/script.js') }}"></script>
</body>
</html>
