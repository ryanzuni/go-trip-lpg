<!-- Toggle Mobile -->
<button id="toggleSidebar"
class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow">
    ☰
</button>

<!-- SIDEBAR -->
<aside id="sidebar"
class="bg-white shadow-xl h-screen fixed top-0 left-0 z-40 transition-all duration-300 w-64 flex flex-col">

    <!-- LOGO -->
    <div class="flex items-center px-5 py-4 border-b">
        <h1 class="text-xl font-bold text-blue-600 sidebar-text">GoTrip</h1>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2 7-7 7 7 2 2M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3"/>
            </svg>

            <span class="sidebar-text">Dashboard</span>
        </a>

        <!-- Destinasi -->
        <a href="{{ route('admin.destinasi.index') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('destinasi.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>

            <span class="sidebar-text">Destinasi</span>
        </a>

        <!-- Paket -->
        <a href="{{ route('admin.paket_wisata.index') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('paket_wisata.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 13V7a2 2 0 00-2-2h-4V3H10v2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"/>
            </svg>

            <span class="sidebar-text">Paket Wisata</span>
        </a>

        <!-- Gallery -->
        <a href="{{ route('admin.galleries.index') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4-4a3 3 0 014.243 0L16 16m-2-2l1-1a3 3 0 014.243 0L20 14"/>
            </svg>

            <span class="sidebar-text">Gallery</span>
        </a>

        <!-- Komentar -->
        <a href="{{ route('admin.comments.index') }}"
        class="group flex items-center gap-3 px-4 py-3 rounded-xl transition
        {{ request()->routeIs('admin.comments.*') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.8-3.6A7.93 7.93 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>

            <span class="sidebar-text">Komentar</span>
        </a>

        <!-- TRANSAKSI -->
        <div class="space-y-1">

            <button onclick="toggleDropdown()"
                class="group w-full flex items-center justify-between px-4 py-3 rounded-xl transition text-gray-600 hover:bg-gray-100">

                <span class="flex items-center gap-3">

                    <!-- ✅ CREDIT CARD ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <rect x="2" y="5" width="20" height="14" rx="2" stroke-width="2"/>
                        <path d="M2 10h20" stroke-width="2"/>
                    </svg>

                    <span class="sidebar-text">Transaksi</span>
                </span>

                <svg id="chevron" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- SUBMENU -->
            <div id="submenu" class="hidden ml-8 pl-4 border-l space-y-1">

                <a href="{{ route('admin.transaksi.index') }}"
                    class="block text-sm px-3 py-2 rounded-lg transition text-gray-500 hover:bg-blue-50 hover:text-blue-600">
                    Data Transaksi
                </a>

                <a href="{{ route('admin.data-masters.index') }}"
                    class="block text-sm px-3 py-2 rounded-lg transition text-gray-500 hover:bg-blue-50 hover:text-blue-600">
                    Data Master
                </a>

            </div>

        </div>

    </nav>
</aside>

<script>
function toggleDropdown() {
    const menu = document.getElementById('submenu');
    const icon = document.getElementById('chevron');

    menu.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

document.getElementById('toggleSidebar').addEventListener('click', () => {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('w-64');
    sidebar.classList.toggle('w-20');

    document.querySelectorAll('.sidebar-text').forEach(el => {
        el.classList.toggle('hidden');
    });
});
</script>