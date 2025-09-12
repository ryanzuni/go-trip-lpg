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

<div class="px-4 py-3">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            
            <!-- Tombol Toggle Sidebar -->
            <button class="btn btn-light me-3" id="toggleSidebar">
                <i class="bi bi-list fs-5"></i>
            </button>

            <!-- Dropdown User -->
            <div class="dropdown">
                <a class="text-muted text-decoration-none" 
                   href="#" role="button" id="userMenu" 
                   data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $greeting }}, {{ Auth::user()->name ?? 'Guest' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3" aria-labelledby="userMenu">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
