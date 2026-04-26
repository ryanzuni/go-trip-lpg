@extends('layouts.app')
@section('title','Profil Admin')

@section('content')

<div class="p-6 max-w-3xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6 flex items-center gap-3">
        <!-- User Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A9 9 0 1118.879 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>

        <div>
            <h2 class="text-xl font-semibold text-gray-800">Profil Admin</h2>
            <p class="text-sm text-gray-500">Kelola informasi akun Anda</p>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow-sm p-6">

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm flex items-center gap-2">
                <!-- Check Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('settings/profile') }}" class="space-y-5">
            @csrf

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

            <!-- ACTION -->
            <div class="flex justify-end pt-4">

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow flex items-center gap-2">

                    <!-- Save Icon -->
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