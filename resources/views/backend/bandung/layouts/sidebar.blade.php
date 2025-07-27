<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard</title>

    <style>
        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            padding: 15px;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
        }

        .sidebar .section-title {
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 15px;
            color: #ecf0f1;
        }

        .sidebar .nav {
            list-style: none;
            padding: 0;
        }

        .sidebar .nav-item {
            padding: 5px 0;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 10px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #1abc9c;
            border-radius: 5px;
        }

        .sidebar .sidebar-icon {
            margin-right: 10px;
        }

        /* Content Wrapper */
        .content-wrapper {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 250px;
            padding: 20px;
        }

        .content-wrapper.full {
            margin-left: 0;
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            background: #1abc9c;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 5px;
            display: none;
            z-index: 1100;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-car"></i> AutoRent
        </div>
        <div class="section-title">Menu Admin</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    <span class="sidebar-icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard
                </a>
            </li>
            <div @class(['d-none' => $role != 'super_admin'])>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('cabang') ? 'active' : '' }}" href="{{ route('cabang.index') }}">
                        <span class="sidebar-icon"><i class="fa-solid fa-code-branch"></i></span> Cabang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('driver') ? 'active' : '' }}" href="{{ route('driver.index') }}">
                        <span class="sidebar-icon"><i class="fa-regular fa-id-card"></i></span> Pengemudi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('kendaraan') ? 'active' : '' }}" href="{{ route('kendaraan.index') }}">
                        <span class="sidebar-icon"><i class="fa-solid fa-car"></i></span> Kendaraan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <span class="sidebar-icon"><i class="fa-solid fa-user"></i></span> Pengguna
                    </a>
                </li>
            </div>
        </ul>
        <div class="section-title">Transaksi</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('rental') ? 'active' : '' }}" href="{{ route('rental.index') }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-handshake"></i></span> Rental
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('CashIn') ? 'active' : '' }}" href="{{ route('CashIn.index') }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-cash-register"></i></span> Cash In
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('CashOut') ? 'active' : '' }}" href="{{ route('CashOut.index') }}">
                    <span class="sidebar-icon"><i class="   fa-solid fa-money-bills"></i></span> Cash Out
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('actionlogout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                    <span class="sidebar-icon"><i class="fas fa-sign-out"></i></span> Sign Out
                </a>

                <form id="logout-form" action="{{ route('actionlogout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Button Toggle Sidebar -->
    <button class="sidebar-toggle">☰</button>

    <!-- Wrapper untuk Konten -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('.sidebar-toggle');
            const contentWrapper = document.querySelector('.content-wrapper');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                contentWrapper.classList.toggle('full');

                // Pindahkan toggle button ke samping sidebar saat terbuka
                if (sidebar.classList.contains('show')) {
                    toggleButton.style.left = '260px';
                } else {
                    toggleButton.style.left = '15px';
                }
            }

            toggleButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah klik pada toggle menutup sidebar
                toggleSidebar();
            });

            // Tutup sidebar saat area luar sidebar diklik
            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                    sidebar.classList.remove('show');
                    contentWrapper.classList.remove('full');
                    toggleButton.style.left = '15px'; // Kembalikan tombol toggle ke posisi awal
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    contentWrapper.classList.remove('full');
                    toggleButton.style.left = '15px'; // Kembalikan posisi tombol toggle
                }
            });
        });
    </script>

    <!-- Bootstrap CSS (Versi 5.3.3) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome (Versi terbaru 6.7.1) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap JS (Versi 5.3.3) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>