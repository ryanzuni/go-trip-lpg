@php
    $hour = now('Asia/Jakarta')->format('H');
    if ($hour >= 5 && $hour < 12) {
        $greeting = 'Selamat pagi';
    } elseif ($hour >= 12 && $hour < 15) {
        $greeting = 'Selamat siang';
    } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'Selamat sore';
    } else {
        $greeting = 'Selamat malam';
    }
@endphp

<div class="p-4">
    <div class="flex items-center justify-between bg-white rounded-2xl shadow px-5 py-3">

        <!-- LEFT -->
        <button id="toggleSidebar"
            class="p-2 rounded-lg hover:bg-gray-100 transition">
            
            <!-- HEROICON MENU -->
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-gray-600"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- RIGHT -->
        <div class="relative">

            <!-- TRIGGER -->
            <button onclick="toggleUserMenu()"
                class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">

                <span class="text-sm">
                    {{ $greeting }}, {{ Auth::user()->name ?? 'Guest' }}
                </span>

                <!-- HEROICON CHEVRON -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- DROPDOWN -->
            <div id="userDropdown"
                class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border z-50">

                <a href="{{ route('admin.profile.edit') }}">
                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">

                    <!-- HEROICON USER -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    Profile
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50">

                        <!-- HEROICON LOGOUT -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                        </svg>

                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
function toggleUserMenu() {
    const menu = document.getElementById('userDropdown');
    menu.classList.toggle('hidden');
}

// klik luar nutup dropdown
document.addEventListener('click', function(e) {
    const menu = document.getElementById('userDropdown');
    if (!e.target.closest('#userDropdown') && !e.target.closest('button')) {
        menu.classList.add('hidden');
    }
});
</script>