<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Destinasi Wisata')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">

    @include('layouts.user-header')

    {{-- Bagian konten yang bisa full width --}}
    @yield('banner')

    {{-- Bagian konten yang di-wrap container --}}
    <main class="container mx-auto px-4 py-10">
        @yield('content')
    </main>

    @include('layouts.user-footer')

    <!-- Tailwind Browser CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
