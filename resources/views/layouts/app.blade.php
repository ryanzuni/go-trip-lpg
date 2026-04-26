<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        #sidebar {
            transition: all 0.3s;
            min-height: 100vh;
        }
        .sidebar-collapsed {
            width: 80px !important;
        }
        .sidebar-expanded {
            width: 260px;
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1; /* biar footer tetap di bawah */
        }
        /* Sidebar default lebar */
        .sidebar {
            width: 220px;
            transition: width 0.3s;
        }

        /* Sidebar shrink */
        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none; /* sembunyikan teks saat collapse */
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
        }
    </style>
    
</head>
<body>
    <div class="d-flex">
        @include('layouts.sidebar')

        <div id="mainContent" class="flex-1 ml-64 transition-all duration-300">
            @include('layouts.header')

            <main class="p-6">
                @yield('content')
            </main>

            @include('layouts.footer')
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById("toggleSidebar");
            const sidebar = document.getElementById("sidebar");
            const texts = document.querySelectorAll(".sidebar-text");

            toggleBtn.addEventListener("click", function () {
                sidebar.classList.toggle("sidebar-collapsed");
                sidebar.classList.toggle("sidebar-expanded");

                texts.forEach(el => {
                    el.classList.toggle("d-none");
                });
            });
        });
    </script>
</body>
</html>
