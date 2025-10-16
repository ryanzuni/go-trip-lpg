<!-- Toggle Button (Navbar Atas untuk mobile) -->
<button class="btn btn-primary d-md-none mb-2" id="sidebarToggle">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<div id="sidebar" class="sidebar card shadow-sm border-0 rounded-4 d-flex flex-column sidebar-expanded">
    <div class="card-body d-flex flex-column p-3">

        <!-- Logo -->
        <div class="d-flex align-items-center mb-4">
            <span class="fw-bold fs-5 text-primary sidebar-text">GoTrip Lampung</span>
        </div>

        <ul class="nav flex-column gap-2 flex-fill">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <!-- Destinasi -->
            <!-- <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('destinasi.*') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                   href="{{ route('admin.destinasi.index') }}">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span class="sidebar-text">Destinasi Wisata</span>
                </a>
            </li> -->

            <!-- Paket Wisata -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('paket_wisata.*') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                   href="{{ route('admin.paket_wisata.index') }}">
                    <i class="bi bi-box-seam me-2"></i>
                    <span class="sidebar-text">Paket Wisata</span>
                </a>
            </li>

            <!-- Gallery -->
            <li class="nav-item mb-1">
                <a class="nav-link d-flex align-items-center 
                {{ request()->routeIs('admin.galleries.*') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                href="{{ route('admin.galleries.index') }}">
                    <i class="bi bi-image me-2"></i>
                    <span class="sidebar-text">Gallery</span>
                </a>
            </li>

            <!-- Dropdown Transaksi -->
            <!-- <li class="nav-item">
                <a href="#!" class="nav-link d-flex align-items-center justify-content-between text-dark" 
                onclick="toggleDropdown('transaksiMenu')">
                    <span>
                        <i class="fas fa-cash-register me-2"></i>
                        <span class="sidebar-text">Transaksi</span>
                    </span>
                    <i class="fas fa-chevron-down small-chevron" id="chevron-transaksi"></i>
                </a>
                <ul class="nav flex-column ms-3" id="transaksiMenu" style="display: none;">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('transaksi') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.transaksi.index') }}">
                            <i class="far fa-circle me-2 fs-6"></i><span class="sidebar-text">Data Transaksi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('data-masters') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.data-masters.index') }}">
                            <i class="far fa-circle me-2 fs-6"></i><span class="sidebar-text">Data Master</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <!-- Dropdown Laporan -->
            <li class="nav-item">
                <a href="#!" class="nav-link d-flex align-items-center justify-content-between text-dark"
                onclick="toggleDropdown('laporanMenu')">
                    <span>
                        <i class="fas fa-file-alt me-2"></i>
                        <span class="sidebar-text">Laporan</span>
                    </span>
                    <i class="fas fa-chevron-down small-chevron" id="chevron-laporan"></i>
                </a>
                <ul class="nav flex-column ms-3" id="laporanMenu" style="display:none;">
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan/transaksi') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.laporan.transaksi') }}">
                            <i class="far fa-circle me-2 fs-6"></i>
                            <span class="sidebar-text">Transaksi</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan/booking') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.laporan.booking') }}">
                            <i class="far fa-circle me-2 fs-6"></i>
                            <span class="sidebar-text">Booking</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan/pendapatan') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.laporan.pendapatan') }}">
                            <i class="far fa-circle me-2 fs-6"></i>
                            <span class="sidebar-text">Pendapatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan/paket_wisata') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.laporan.paket_wisata') }}">
                            <i class="far fa-circle me-2 fs-6"></i>
                            <span class="sidebar-text">Paket Wisata</span>
                        </a>
                    </li> -->
                </ul>
            </li>

            <!-- Settings Admin -->
            <!-- <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-between text-dark" 
                href="#!" onclick="toggleDropdown('settingsMenu')">
                    <span>
                        <i class="fas fa-cog me-2"></i>
                        <span class="sidebar-text">Pengaturan</span>
                    </span>
                    <i class="fas fa-chevron-down small-chevron" id="chevron-settings"></i>
                </a>
                <ul class="nav flex-column ms-3" id="settingsMenu" style="display:none;">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('settings/profile') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.settings.profile') }}">
                        <i class="far fa-user me-2 fs-6"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('settings/password') ? 'active text-white bg-primary rounded-3' : 'text-dark' }}" 
                        href="{{ route('admin.settings.password') }}">
                        <i class="fas fa-lock me-2 fs-6"></i> Ubah Password
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>

<!-- Script -->
<script>
    function toggleDropdown(id) {
        const menu = document.getElementById(id);
        const chevron = document.getElementById('chevron-' + id.split('Menu')[0]);

        // Tutup semua dropdown lain dulu
        document.querySelectorAll('ul[id$="Menu"]').forEach(m => {
            if (m.id !== id) {
                m.style.display = 'none';
                const ch = document.getElementById('chevron-' + m.id.split('Menu')[0]);
                if (ch) ch.classList.remove('rotate-180');
            }
        });

        // Toggle menu yang dipilih
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
            chevron.classList.add('rotate-180');
        } else {
            menu.style.display = 'none';
            chevron.classList.remove('rotate-180');
        }
    }

    // Toggle collapse sidebar
    document.getElementById("sidebarToggle").addEventListener("click", function () {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("collapsed");
    });
</script>

<!-- Style -->
<style>
/* Sidebar default */
.sidebar {
    width: 220px;
    transition: width 0.3s;
}

/* Sidebar collapsed */
.sidebar.collapsed {
    width: 60px;
}
.sidebar.collapsed .sidebar-text,
.sidebar.collapsed .small-chevron {
    display: none !important;
}

/* Chevron styling */
.small-chevron {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}
.rotate-180 {
    transform: rotate(180deg);
}
</style>
