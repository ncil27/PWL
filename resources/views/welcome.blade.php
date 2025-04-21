<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ARSA - Academic Request & Submission App</title>
  <link rel="icon" href="{{ asset('templates/assets/images/logo/logo_bulet.png') }}"" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('templates/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/assets/css/app.css') }}">

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background: #f7f9fc;
    }
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 60px 0;

    }
    .hero h1 {
      font-weight: 800;
      font-size: 3rem;
    }
    .hero p {
      font-size: 1.2rem;
      color: #5c6bc0;
      margin-top: 1rem;
    }
    .hero-img img {
      max-width: 100%;
      animation: float 3s ease-in-out infinite;
      filter: drop-shadow(0px 10px 15px rgba(0, 0, 0, 0.555));

    }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>

<body>
    
  <main class="main">
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
            <h1>Sistem Persuratan Mahasiswa Infokom</h1>
            <p>Kelola surat akademik tanpa ribet melalui <b>ARSA - Academic Request & Submission App</b>. Mudah, cepat, dan terpusat.</p>
            <div class="d-flex justify-content-center justify-content-lg-start">
              <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-5">Login</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img text-center">
            <img src="{{ asset('assets/img/hero-img.png') }}" alt="Hero Image" class="img-fluid animated">
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->
  </main>

</body>
</html>
