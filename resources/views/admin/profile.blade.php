@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6 flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5h2m-1-1v2m-7 8l8-8 4 4-8 8H5v-4z"/>
        </svg>

        <div>
            <h2 class="text-xl font-semibold text-gray-800">Edit Profile</h2>
            <p class="text-sm text-gray-500">Perbarui informasi akun Anda</p>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6 w-full">

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- GRID BIAR LEBIH PRO -->
            <div class="grid md:grid-cols-2 gap-6">

                <!-- Nama -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Password (opsional)</label>
                    <input type="password" name="password"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <!-- Confirm -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

            </div>

            <!-- ACTION -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection