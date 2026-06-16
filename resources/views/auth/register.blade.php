<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - GoTrip</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen">

    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
            class="w-full h-full object-cover">
    </div>

    <div class="absolute inset-0 bg-gradient-to-br from-blue-700/70 via-blue-500/50 to-black/70"></div>

    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">

        <div class="w-full max-w-md">

            <div class="text-center mb-6 text-white">
                <h1 class="text-3xl font-bold">GoTrip Lampung</h1>
                <p>Buat akun untuk booking paket wisata</p>
            </div>

            <div class="bg-white/20 backdrop-blur-xl p-6 rounded-2xl">

                @if ($errors->any())
                <div class="mb-4 bg-red-500/20 border border-red-300 text-white p-3 rounded-lg">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="mb-4">
                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Nama Lengkap"
                            class="w-full p-3 rounded-lg"
                            required>
                    </div>

                    <div class="mb-4">
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email"
                            class="w-full p-3 rounded-lg"
                            required>
                    </div>

                    <div class="mb-4">
                        <input type="password"
                            name="password"
                            placeholder="Password"
                            class="w-full p-3 rounded-lg"
                            required>
                    </div>

                    <div class="mb-4">
                        <input type="password"
                            name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            class="w-full p-3 rounded-lg"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-white text-blue-700 py-3 rounded-lg font-semibold">
                        Daftar
                    </button>

                    <div class="text-center mt-4 text-white">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="underline font-semibold">
                            Login
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>