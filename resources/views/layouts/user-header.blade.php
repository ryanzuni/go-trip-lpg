<header class="fixed top-0 left-0 w-full bg-white/70 backdrop-blur-md shadow-lg z-50">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center group">
      <img src="{{ asset('images/logo.jpg') }}" alt="GoTrip Lampung" 
           class="w-12 h-12 object-contain transform transition duration-300 group-hover:scale-110">
    </a>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex items-center space-x-8">
      <a href="{{ route('home') }}"
         class="relative font-medium transition duration-300 
         {{ Request::routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
         Home
         <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-blue-600 transition-all duration-300
          {{ Request::routeIs('home') ? 'w-full' : 'group-hover:w-full' }}"></span>
      </a>

      <a href="{{ route('gallery.index') }}"
        class="relative font-medium transition duration-300 
        {{ Request::routeIs('gallery.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Gallery
        <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-blue-600 transition-all duration-300
          {{ Request::routeIs('gallery.*') ? 'w-full' : 'group-hover:w-full' }}"></span>
      </a>

      <a href="{{ route('destinasi.index') }}"
        class="relative font-medium transition duration-300
        {{ Request::routeIs('destinasi.index') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Destinasi
        <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-blue-600 transition-all duration-300
        {{ Request::routeIs('destinasi.index') ? 'w-full' : 'group-hover:w-full' }}"></span>
      </a>

      <a href="{{ route('paket.index') }}"
        class="relative font-medium transition duration-300 
        {{ Request::routeIs('paket.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Paket Wisata
        <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-blue-600 transition-all duration-300
          {{ Request::routeIs('paket.*') ? 'w-full' : 'group-hover:w-full' }}"></span>
      </a>

      <a href="{{ route('contact') }}"
        class="relative font-medium transition duration-300 
        {{ Request::routeIs('contact.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Contact
        <span class="absolute left-0 -bottom-1 h-0.5 w-0 bg-blue-600 transition-all duration-300
          {{ Request::routeIs('contact.*') ? 'w-full' : 'group-hover:w-full' }}"></span>
      </a>
    </nav>

    <!-- Mobile Menu Button -->
    <button class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none" id="menu-toggle">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md shadow-md border-t animate-slideDown">
    <nav class="flex flex-col px-6 py-4 space-y-3">
      <a href="{{ route('home') }}" class="font-medium {{ Request::routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Home
      </a>
      <a href="{{ route('gallery.index') }}" 
        class="font-medium {{ Request::routeIs('gallery.*') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
        Gallery
      </a>
      <a href="{{ route('destinasi.index') }}" 
        class="font-medium {{ Request::routeIs('destinasi.index') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
          Destinasi
      </a>
      <a href="#contact" class="font-medium text-gray-700 hover:text-blue-600">Contact</a>
      <a href="#explore" class="bg-gradient-to-r from-blue-500 to-cyan-400 text-white px-4 py-2 rounded-full shadow-md text-center">
        Explore
      </a>
    </nav>
  </div>
</header>

<!-- Padding agar konten tidak ketutup navbar -->
<div class="pt-24"></div>

<script>
  // Toggle mobile menu
  const menuToggle = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  menuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>

<style>
  /* Animasi slide down */
  @keyframes slideDown {
    0% { transform: translateY(-10px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
  }
  .animate-slideDown {
    animation: slideDown 0.3s ease forwards;
  }
</style>
