<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex justify-center items-center bg-blue-600">

<div class="bg-white p-8 rounded-xl w-96">

    <h2 class="text-2xl font-bold text-center mb-2">
        Verifikasi Email
    </h2>

    <p class="text-center text-gray-500 mb-5">
        Masukkan kode OTP yang dikirim ke email Anda
    </p>

    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <input
            type="text"
            name="otp"
            maxlength="6"
            class="w-full border p-3 rounded-lg text-center text-2xl tracking-widest"
            placeholder="123456"
            required
        >

        <button
            type="submit"
            class="w-full mt-4 bg-blue-600 text-white p-3 rounded-lg">
            Verifikasi
        </button>
    </form>

</div>

</body>
</html>