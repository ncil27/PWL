<x-app-layout>
  <!-- Navbar -->
  <x-navbar />

  <!-- Main Content -->
  <div class="container mx-auto mt-10">
      @yield('content')
  </div>

  <!-- Footer -->
  <x-footer />
</x-app-layout>
