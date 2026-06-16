@extends('layouts.user-app')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-6xl mx-auto">

        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- Cover -->
            <div class="h-40 bg-gradient-to-r from-blue-600 via-cyan-500 to-sky-400 relative">

                <div class="absolute inset-0 bg-black/10"></div>

            </div>

            <!-- Profile Header -->
            <div class="px-8 pb-10">

                <div class="-mt-20 flex flex-col items-center">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=300&background=ffffff&color=2563eb"
                        class="w-36 h-36 rounded-full border-4 border-white shadow-2xl ring-4 ring-blue-100">

                    <h1 class="mt-4 text-3xl font-bold text-gray-800">
                        {{ $user->name }}
                    </h1>

                    <p class="text-gray-500">
                        {{ $user->email }}
                    </p>

                </div>

                <!-- Statistik -->
                <!-- Statistik -->
                <div class="grid md:grid-cols-4 gap-5 mt-10">

                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-3xl font-bold">
                            {{ $totalBooking }}
                        </h3>
                        <p class="mt-2 text-blue-100">
                            Total Booking
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-3xl font-bold">
                            {{ $totalSuccess }}
                        </h3>
                        <p class="mt-2 text-green-100">
                            Pembayaran Lunas
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-amber-400 to-orange-500 text-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-3xl font-bold">
                            {{ $totalPending }}
                        </h3>
                        <p class="mt-2 text-amber-100">
                            Pending
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-2xl p-6 shadow-lg">
                        <h3 class="text-2xl font-bold">
                            Rp {{ number_format($totalSpent,0,',','.') }}
                        </h3>
                        <p class="mt-2 text-purple-100">
                            Total Pengeluaran
                        </p>
                    </div>

                </div>

                <div class="mt-12">

                    <h2 class="text-2xl font-bold mb-6">
                        Riwayat Booking
                    </h2>

                    <div class="space-y-4">

                        @forelse($bookings as $booking)

                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition overflow-hidden">

                            <div class="p-6">

                                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">

                                    <div>

                                        <h3 class="text-xl font-bold text-slate-800">
                                            {{ $booking->paketWisata->nama_paket }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            Booking ID: BOOK-{{ $booking->id }}
                                        </p>

                                        <div class="mt-4 space-y-1 text-sm text-slate-600">

                                            <p class="flex items-center gap-2">
                                                <i class="fas fa-calendar-alt text-blue-500"></i>
                                                {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                            </p>

                                            <p class="flex items-center gap-2">
                                                <i class="fas fa-users text-green-500"></i>
                                                {{ $booking->jumlah_orang }} Orang
                                            </p>

                                        </div>

                                    </div>

                                    <div class="text-right">

                                        <p class="text-sm text-slate-500">
                                            Total Pembayaran
                                        </p>

                                        <p class="text-2xl font-bold text-blue-600">
                                            Rp {{ number_format($booking->total_harga,0,',','.') }}
                                        </p>

                                        @if(in_array(strtolower($booking->status), ['success','settlement','capture','paid']))

                                        <span class="mt-3 inline-flex px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                            SUCCESS
                                        </span>

                                        @elseif(strtolower($booking->status) == 'pending')

                                        <span class="mt-3 inline-flex px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                            PENDING
                                        </span>

                                        @else

                                        <span class="mt-3 inline-flex px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                            BATAL
                                        </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="flex gap-3 mt-5">

                                    <a href="{{ route('booking.show',$booking->id) }}"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                                        Detail Booking

                                    </a>

                                    <a href="{{ route('booking.invoice',$booking->id) }}"
                                        class="px-4 py-2 border border-slate-300 hover:bg-slate-50 rounded-xl transition">

                                        Download Invoice

                                    </a>

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="bg-white rounded-2xl p-10 text-center border border-dashed">

                            <div class="text-5xl mb-3">
                                ✈️
                            </div>

                            <h3 class="font-bold text-lg">
                                Belum Ada Riwayat Booking
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Booking paket wisata pertama kamu sekarang.
                            </p>

                            <a href="{{ route('paket.index') }}"
                                class="inline-flex mt-5 px-5 py-3 bg-blue-600 text-white rounded-xl">

                                Lihat Paket Wisata

                            </a>

                        </div>

                        @endforelse

                    </div>

                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>

                </div>

                <!-- Form -->
                <div class="mt-12">

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Edit Profil
                    </h2>

                    <div class="grid md:grid-cols-3 gap-5 mt-8">

                        <div class="bg-slate-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-semibold">{{ $user->email }}</p>
                        </div>

                        <div class="bg-slate-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Member Sejak</p>
                            <p class="font-semibold">
                                {{ $user->created_at->format('d M Y') }}
                            </p>
                        </div>

                        <div class="bg-slate-50 p-5 rounded-2xl">
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-semibold text-green-600">
                                Aktif
                            </p>
                        </div>

                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <label class="block mb-2 font-medium text-gray-700">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-gray-700">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-gray-700">
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <small class="text-gray-500">
                                    Kosongkan jika tidak ingin mengganti password
                                </small>
                            </div>

                            <div>
                                <label class="block mb-2 font-medium text-gray-700">
                                    Konfirmasi Password
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                        </div>

                        <button
                            type="submit"
                            class="mt-8 px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection