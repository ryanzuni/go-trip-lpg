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
                <div class="grid md:grid-cols-3 gap-5 mt-10">

                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl p-6">
                        <h3 class="text-3xl font-bold text-blue-600">
                            0
                        </h3>
                        <p class="text-gray-600">
                            Total Booking
                        </p>
                        <i class="fas fa-suitcase-rolling text-3xl mb-2"></i>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl p-6">
                        <h3 class="text-3xl font-bold text-green-600">
                            0
                        </h3>
                        <p class="text-gray-600">
                            Pembayaran Lunas
                        </p>
                        <i class="fas fa-check-circle text-3xl mb-2"></i>
                    </div>

                    <div class="bg-gradient-to-r from-amber-400 to-orange-500 text-white rounded-2xl p-6">
                        <h3 class="text-3xl font-bold text-yellow-600">
                            0
                        </h3>
                        <p class="text-gray-600">
                            Pending
                        </p>
                        <i class="fas fa-clock text-3xl mb-2"></i>
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