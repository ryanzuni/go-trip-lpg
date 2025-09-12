@extends('layouts.user-app')

@section('title', 'Beranda - Pariwisata Kita')

@section('content')

@section('banner')
<!-- Hero 3D Slider Modern Full Width -->
<section class="w-screen h-[80vh] overflow-hidden relative" id="hero-3d-modern-slider">
    <!-- Background full width -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/banner1.jpeg') }}" alt="Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <!-- Slider 3D -->
    <div class="relative z-10 w-full h-full flex items-center justify-center perspective">
        @php
            $banners = ['banner1.jpeg','banner2.jpeg','banner3.jpeg'];
        @endphp
        @foreach($banners as $banner)
        <div class="slide absolute w-4/5 h-[75vh] rounded-3xl bg-cover bg-center shadow-2xl transition-transform duration-700"
             style="background-image: url('{{ asset('images/'.$banner) }}');"></div>
        @endforeach
    </div>

    <!-- Konten teks -->
    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center text-white px-4">
        <h1 class="text-5xl md:text-6xl font-bold mb-4 drop-shadow-lg leading-tight">Jelajahi Keindahan Indonesia</h1>
        <p class="text-xl md:text-2xl opacity-90 mb-6 drop-shadow-md">Temukan destinasi wisata terpopuler pilihan kami</p>
        <div class="flex space-x-4 mb-6">
            <button id="prev-modern" class="bg-white text-black px-5 py-2 rounded-full shadow hover:bg-gray-200 transition transform hover:-translate-y-1">Prev</button>
            <button id="next-modern" class="bg-white text-black px-5 py-2 rounded-full shadow hover:bg-gray-200 transition transform hover:-translate-y-1">Next</button>
        </div>
        <div id="slider-indicators" class="flex justify-center space-x-2">
            <span class="w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer"></span>
            <span class="w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer"></span>
            <span class="w-3 h-3 bg-white rounded-full opacity-50 cursor-pointer"></span>
        </div>
    </div>
</section>

<!-- Destinasi Terpopuler -->
<section id="destinasi" class="mt-20">
    <h2 class="text-3xl font-bold text-blue-600 mb-10 text-center">Destinasi Terpopuler</h2>

    @if($destinasi->count() == 0)
        <p class="text-gray-400 text-center">Belum ada data destinasi wisata.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">
            @foreach($destinasi as $item)
            <a href="{{ route('user.destinasi.show', $item->id) }}" class="group relative rounded-2xl overflow-hidden shadow-lg cursor-pointer transform transition duration-500 hover:scale-[1.05] hover:shadow-2xl">

                @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" 
                     alt="{{ $item->nama }}" 
                     class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110 group-hover:brightness-90">
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent flex flex-col justify-end p-6 transition-all duration-500 group-hover:from-black/70 group-hover:via-black/50">
                    <h3 class="text-lg md:text-xl font-bold text-white">{{ $item->nama }}</h3>
                    <p class="text-sm md:text-base text-gray-200">{{ $item->lokasi }}</p>
                    <p class="text-yellow-300 font-semibold mt-1 text-sm md:text-base">
                        {{ $item->harga_tiket ? 'Rp ' . number_format($item->harga_tiket,0,',','.') : 'Gratis' }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</section>

<!-- Fasilitas -->
<section class="bg-gray-50 py-16 mt-20">
    <h2 class="text-3xl font-bold text-blue-600 mb-12 text-center">Fasilitas yang Tersedia</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 max-w-6xl mx-auto px-6 text-center">
        @php
            $fasilitas = [
                ['icon'=>'fa-parking','color'=>'blue','label'=>'Parkir Luas'],
                ['icon'=>'fa-utensils','color'=>'green','label'=>'Kuliner'],
                ['icon'=>'fa-wifi','color'=>'yellow','label'=>'Free Wifi'],
                ['icon'=>'fa-restroom','color'=>'red','label'=>'Toilet'],
                ['icon'=>'fa-tree','color'=>'purple','label'=>'Taman'],
                ['icon'=>'fa-hotel','color'=>'pink','label'=>'Hotel'],
            ];
        @endphp
        @foreach($fasilitas as $item)
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transform hover:-translate-y-2 active:scale-95 transition cursor-pointer">
            <div class="w-16 h-16 mx-auto flex items-center justify-center bg-{{ $item['color'] }}-100 text-{{ $item['color'] }}-600 rounded-full mb-3 shadow-inner">
                <i class="fas {{ $item['icon'] }} text-2xl"></i>
            </div>
            <p class="font-medium text-gray-700">{{ $item['label'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Kenapa Memilih Kami -->
<section class="py-20 bg-gradient-to-r from-blue-50 to-blue-100 mt-20">
    <h2 class="text-3xl font-bold text-blue-700 mb-12 text-center">Kenapa Memilih Pariwisata Kita?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
            <i class="fas fa-wallet text-blue-600 text-4xl mb-4"></i>
            <h3 class="text-lg font-semibold mb-2">Harga Terjangkau</h3>
            <p class="text-gray-600">Nikmati liburan hemat dengan paket wisata pilihan terbaik.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
            <i class="fas fa-bus text-green-600 text-4xl mb-4"></i>
            <h3 class="text-lg font-semibold mb-2">Akses Mudah</h3>
            <p class="text-gray-600">Destinasi populer dengan akses transportasi yang nyaman.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition">
            <i class="fas fa-gift text-pink-600 text-4xl mb-4"></i>
            <h3 class="text-lg font-semibold mb-2">Banyak Promo</h3>
            <p class="text-gray-600">Dapatkan promo menarik setiap bulannya untuk liburan seru.</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="mt-20 bg-gray-50 py-16 px-6 rounded-3xl shadow-inner">
  <h2 class="text-3xl font-bold text-blue-600 text-center mb-10">Pertanyaan yang Sering Diajukan</h2>
  
  <div class="max-w-3xl mx-auto space-y-4">
    <!-- Item 1 -->
    <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden">
      <button onclick="toggleFaq(1)" 
        class="w-full flex justify-between items-center px-5 py-4 text-left text-lg font-medium text-gray-700 hover:text-blue-600 transition">
        <span><i class="fas fa-question-circle text-blue-500 mr-2"></i> Bagaimana cara memesan tiket?</span>
        <i id="icon-1" class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div id="faq-1" class="max-h-0 overflow-hidden transition-all duration-500 px-5">
        <p class="text-gray-600 py-3">
          Anda dapat memesan tiket secara online melalui website ini pada bagian destinasi.
        </p>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden">
      <button onclick="toggleFaq(2)" 
        class="w-full flex justify-between items-center px-5 py-4 text-left text-lg font-medium text-gray-700 hover:text-blue-600 transition">
        <span><i class="fas fa-ticket-alt text-blue-500 mr-2"></i> Apakah ada diskon untuk rombongan?</span>
        <i id="icon-2" class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div id="faq-2" class="max-h-0 overflow-hidden transition-all duration-500 px-5">
        <p class="text-gray-600 py-3">
          Ya, kami menyediakan diskon khusus untuk rombongan di atas 10 orang. Silakan hubungi kami.
        </p>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden">
      <button onclick="toggleFaq(3)" 
        class="w-full flex justify-between items-center px-5 py-4 text-left text-lg font-medium text-gray-700 hover:text-blue-600 transition">
        <span><i class="fas fa-car text-blue-500 mr-2"></i> Apakah tersedia transportasi menuju lokasi?</span>
        <i id="icon-3" class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div id="faq-3" class="max-h-0 overflow-hidden transition-all duration-500 px-5">
        <p class="text-gray-600 py-3">
          Beberapa destinasi menyediakan transportasi tambahan, detail bisa dilihat di informasi destinasi.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="py-20 bg-blue-600 text-white text-center rounded-t-3xl shadow-lg mt-20">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap untuk Liburan?</h2>
    <p class="mb-8 text-lg opacity-90">Jelajahi destinasi terbaik di Indonesia sekarang juga.</p>
    <a href="{{ route('user.destinasi.index') }}" 
      class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-full shadow hover:bg-gray-100 transition">
        Lihat Semua Destinasi
    </a>

</section>

<style>
/* Animasi fade-in */
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-in { animation: fadeIn 0.8s ease forwards; }
.animate-fade-in.delay-200 { animation-delay: 0.2s; }

/* Animasi kartu */
@keyframes fadeCard { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.animate-fade-card { animation: fadeCard 0.6s ease forwards; }

/* Pulse & bounce */
.animate-pulse { animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1;} 50%{opacity:0.7;} }
.animate-bounce { animation: bounce 2s infinite; }
@keyframes bounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-5px);} }
</style>

<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>
<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.4s ease-out;
}
</style>

<script>
function toggleFaq(id) {
  const faq = document.getElementById(`faq-${id}`);
  const icon = document.getElementById(`icon-${id}`);
  
  if (faq.classList.contains("max-h-0")) {
    faq.classList.remove("max-h-0");
    faq.classList.add("max-h-40"); // Bisa sesuaikan tingginya
    icon.classList.add("rotate-180");
  } else {
    faq.classList.add("max-h-0");
    faq.classList.remove("max-h-40");
    icon.classList.remove("rotate-180");
  }
}
</script>

<script>
const slidesModern = document.querySelectorAll('#hero-3d-modern-slider .slide');
const indicators = document.querySelectorAll('#slider-indicators span');
let currentModern = 0;

function updateModernSlider() {
    slidesModern.forEach((slide, i) => {
        if(i === currentModern) {
            slide.style.transform = 'translateX(0) scale(1) rotateY(0deg)';
            slide.style.zIndex = 10;
            slide.style.opacity = 1;
            slide.style.filter = 'blur(0px)';
        } else if(i === (currentModern-1+slidesModern.length)%slidesModern.length) {
            slide.style.transform = 'translateX(-30%) scale(0.8) rotateY(20deg)';
            slide.style.zIndex = 5;
            slide.style.opacity = 0.6;
            slide.style.filter = 'blur(2px)';
        } else if(i === (currentModern+1)%slidesModern.length) {
            slide.style.transform = 'translateX(30%) scale(0.8) rotateY(-20deg)';
            slide.style.zIndex = 5;
            slide.style.opacity = 0.6;
            slide.style.filter = 'blur(2px)';
        } else {
            slide.style.transform = 'translateX(0) scale(0.7) rotateY(0deg)';
            slide.style.zIndex = 1;
            slide.style.opacity = 0;
            slide.style.filter = 'blur(4px)';
        }
    });

    // Update indikator
    indicators.forEach((dot, i) => dot.classList.remove('active'));
    indicators[currentModern].classList.add('active');
}

// Kontrol slider
document.getElementById('prev-modern').addEventListener('click', () => {
    currentModern = (currentModern - 1 + slidesModern.length) % slidesModern.length;
    updateModernSlider();
});
document.getElementById('next-modern').addEventListener('click', () => {
    currentModern = (currentModern + 1) % slidesModern.length;
    updateModernSlider();
});

// Klik indikator
indicators.forEach((dot, i) => {
    dot.addEventListener('click', () => {
        currentModern = i;
        updateModernSlider();
    });
});

// Autoplay
setInterval(() => {
    currentModern = (currentModern + 1) % slidesModern.length;
    updateModernSlider();
}, 6000);

// Inisialisasi
updateModernSlider();
</script>

<style>
.perspective {
    perspective: 1500px;
}
#hero-3d-modern-slider .slide {
    transition: transform 0.7s ease, opacity 0.7s ease, filter 0.7s ease;
    backface-visibility: hidden;
    cursor: pointer;
}
#slider-indicators span.active {
    opacity: 1 !important;
    transform: scale(1.3);
    transition: all 0.3s ease;
}
</style>

@endsection
