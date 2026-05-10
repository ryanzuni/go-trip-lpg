<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - GoTrip</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen">

<!-- BACKGROUND IMAGE -->
<div class="absolute inset-0">
    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
         class="w-full h-full object-cover">
</div>

<!-- OVERLAY -->
<div class="absolute inset-0 bg-gradient-to-br from-blue-700/70 via-blue-500/50 to-black/70"></div>

<!-- CONTENT -->
<div class="relative z-10 flex items-center justify-center min-h-screen px-4">

    <div class="w-full max-w-md">

        <!-- BRAND -->
        <div class="text-center mb-6 text-white">
            <div class="w-14 h-14 bg-white/20 backdrop-blur rounded-full flex items-center justify-center mx-auto mb-3 shadow">
                
                <!-- Heroicon -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold">GoTrip Lampung</h1>
            <p class="text-sm opacity-80">Admin Panel</p>
        </div>

        <!-- CARD -->
        <div class="bg-white/20 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-white/20">

            <form method="POST" action="{{ url('/login') }}" class="space-y-4 text-white">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        class="mt-1 w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 focus:ring-2 focus:ring-white outline-none"
                        placeholder="admin@gotrip.id"
                        required>
                </div>

                                                                                                                                                                            <!-- PASSWORD -->
                <!-- PASSWORD -->
                <div>
                    <label class="text-sm">Password</label>
                    <div class="relative mt-1">
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/30 placeholder-white/60 focus:ring-2 focus:ring-white outline-none"
                            placeholder="••••••••"
                            required>

                        <!-- HEROICON BUTTON -->
                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-2.5 text-white/70 hover:text-white">

                            <!-- Eye -->
                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                                    c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7
                                    -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>

                            <!-- Eye Slash -->
                            <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19
                                    c-4.478 0-8.268-2.943-9.542-7
                                    a9.956 9.956 0 012.042-3.368m3.132-2.446
                                    A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7
                                    a9.97 9.97 0 01-4.132 5.411M15 12a3 3 0 00-3-3
                                    m0 0a3 3 0 00-2.83 2M3 3l18 18"/>
                            </svg>

                        </button>
                    </div>
                </div>

                <!-- REMEMBER -->
                <div class="flex justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="accent-white">
                        Ingat saya
                    </label>
                    <!-- <a href="#" class="underline hover:text-blue-200">Lupa password?</a> -->
                </div>

                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-white text-blue-700 font-semibold py-2 rounded-lg hover:bg-blue-100 transition">
                    Login
                </button>

            </form>
        </div>

        <!-- FOOTER -->
        <p class="text-center text-white/70 text-xs mt-4">
            © 2026 GoTrip Lampung
        </p>

    </div>

</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const open = document.getElementById('eyeOpen');
    const close = document.getElementById('eyeClose');

    if (input.type === 'password') {
        input.type = 'text';
        open.classList.add('hidden');
        close.classList.remove('hidden');
    } else {
        input.type = 'password';
        open.classList.remove('hidden');
        close.classList.add('hidden');
    }
}
</script>

</body>
</html>