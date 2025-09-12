@extends('layouts.user-app')

@section('title', 'Contact Us - Pariwisata Kita')

@section('content')
<section class="py-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <!-- Judul -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
                Hubungi <span class="text-blue-600">Pariwisata Kita</span>
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Rencanakan perjalanan wisata Anda bersama kami, titik keberangkatan utama dari 
                <strong>Dermaga Wisata Ketapang</strong>, Pesawaran – Lampung 🚤✨.
            </p>
        </div>

        <!-- Grid Kontak + Form -->
        <div class="grid md:grid-cols-2 gap-10">
            <!-- Info Kontak -->
            <div class="space-y-6">
                <!-- Phone -->
                <div class="flex items-center p-6 bg-white border rounded-2xl shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full mr-4">
                        <!-- Lucide phone -->
                        <i data-lucide="phone" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Telepon</p>
                        <p class="text-lg font-semibold text-gray-800">+62 812 3456 7890</p>
                    </div>
                </div>
                <!-- WhatsApp -->
                <a href="https://wa.me/6281234567890" target="_blank"
                   class="flex items-center p-6 bg-white border rounded-2xl shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 flex items-center justify-center bg-green-100 text-green-600 rounded-full mr-4">
                        <!-- Lucide message-circle -->
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">WhatsApp</p>
                        <p class="text-lg font-semibold text-gray-800">+62 812 3456 7890</p>
                    </div>
                </a>
                <!-- Email -->
                <div class="flex items-center p-6 bg-white border rounded-2xl shadow hover:shadow-lg transition">
                    <div class="w-14 h-14 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-full mr-4">
                        <!-- Lucide mail -->
                        <i data-lucide="mail" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="text-lg font-semibold text-gray-800">info@pariwisatakita.com</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    <input type="text" name="name" 
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition text-gray-700" 
                        placeholder="Nama Anda" required>
                    <input type="email" name="email" 
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition text-gray-700" 
                        placeholder="Email Anda" required>
                    <textarea name="message" rows="5"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition text-gray-700" 
                        placeholder="Tulis pesan Anda..." required></textarea>
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-500 to-cyan-400 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-xl transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-20">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lokasi Utama Kami</h2>
            <p class="text-center text-gray-600 mb-6">
                Dermaga Wisata Ketapang, Desa Batumenyan, Kabupaten Pesawaran, Lampung 35450
            </p>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.995086476148!2d105.24528207472958!3d-5.540557954426665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db34dbe95f3b%3A0x87f0dcb6576a5f7!2sDermaga%20Wisata%20Ketapang!5e0!3m2!1sid!2sid!4v1693999999999!5m2!1sid!2sid&maptype=satellite"
                    width="100%" height="450" 
                    style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Load Lucide icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
