<footer class="bg-white border-t border-gray-200 mt-10">
  <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-10">
    
    <!-- Logo & About -->
    <div>
      <div class="flex items-center space-x-3 mb-4">
        <img src="{{ asset('images/logo.jpg') }}" alt="Pariwisata Kita" class="w-12 h-12 object-contain">
        <span class="text-2xl font-bold text-gray-800">GoTrip Lampung</span>
      </div>
      <!-- <p class="text-gray-600 text-sm leading-relaxed">
        Platform untuk menemukan destinasi terbaik di Indonesia. 
        Temukan keindahan alam & budaya nusantara bersama kami.
      </p> -->
    </div>

    <!-- Quick Links -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Jelajahi</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="/" class="hover:text-blue-600 transition">Home</a></li>
        <li><a href="/gallery" class="hover:text-blue-600 transition">Gallery</a></li>
        <li><a href="/paket-wisata" class="hover:text-blue-600 transition">Paket Wisata</a></li>
        <!-- <li><a href="/contact" class="hover:text-blue-600 transition">Contact</a></li> -->
      </ul>
    </div>

    <!-- Contact -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Kontak</h3>
      <ul class="space-y-2 text-sm text-gray-600">
        <li>Jl. Way Ratai Jl. Tlk No.5, Gebang, Kec. Padang Cermin, Kabupaten Pesawaran, Lampung</li>
        <li>Dermaga 3 Ketapang</li>
        <li>+6285760794223</li>
      </ul>
    </div>

    <!-- Social Media -->
    <div>
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Ikuti Kami</h3>
      <div class="flex space-x-4">
        <!-- <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-blue-600 hover:text-white transition">
          <i class="fab fa-facebook-f"></i>
        </a> -->
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-pink-600 hover:text-white transition">
          <i class="fab fa-instagram"></i>
        </a>
        <!-- <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-sky-500 hover:text-white transition">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-red-600 hover:text-white transition">
          <i class="fab fa-youtube"></i>
        </a> -->
      </div>
    </div>

  </div>

  <!-- Bottom -->
  <div class="border-t border-gray-200 mt-8 py-4 text-center text-sm text-gray-500">
    &copy; {{ date('Y') }} GoTrip Lampung. All rights reserved.
  </div>
</footer>
