<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ITECH - Penerimaan Mahasiswa Baru</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-vh-100 bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container">
                <!-- Logo di KIRI -->
                <a class="navbar-brand d-flex align-items-center" href="{{ route('beranda') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo ITECH" class="me-2" style="height: 40px; width: auto;">
                    <span class="fw-bold fs-4 text-primary">ITECH</span>
                </a>

                <!-- Tombol Hamburger untuk mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu di KANAN - PAKAI AUTH LANGSUNG -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        
                        @if(Auth::guard('admin')->check())
                            <!-- ADMIN LOGIN -->
                            @php $admin = Auth::guard('admin')->user(); @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold px-3" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-cog me-2"></i>{{ $admin->nama }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.calon-mahasiswa.index') }}"><i class="fas fa-users me-2"></i>Calon Mahasiswa</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.soal.index') }}"><i class="fas fa-question-circle me-2"></i>Manajemen Soal</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.kelulusan.index') }}"><i class="fas fa-clipboard-check me-2"></i>Kelulusan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.daftar-ulang.index') }}"><i class="fas fa-file-upload me-2"></i>Daftar Ulang</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @elseif(Auth::guard('web')->check())
                            <!-- MAHASISWA LOGIN -->
                            @php $user = Auth::guard('web')->user(); @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold px-3" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-graduate me-2"></i>{{ $user->nama_lengkap }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.data-pribadi') }}"><i class="fas fa-user me-2"></i>Data Pribadi</a></li>
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.ujian.index') }}"><i class="fas fa-pencil-alt me-2"></i>Ujian</a></li>
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.hasil') }}"><i class="fas fa-file-alt me-2"></i>Hasil Ujian</a></li>
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.daftar-ulang.index') }}"><i class="fas fa-upload me-2"></i>Daftar Ulang</a></li>
                                    <li><a class="dropdown-item" href="{{ route('mahasiswa.kartu') }}"><i class="fas fa-id-card me-2"></i>Kartu Mahasiswa</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('auth.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @else
                            <!-- GUEST (BELUM LOGIN) -->
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}">Beranda</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}#program-studi">Program Studi</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}#alur">Alur</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}#jadwal">Jadwal</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}#faq">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link fw-semibold px-3" href="{{ route('beranda') }}#kontak">Kontak</a></li>
                            <li class="nav-item"><a class="btn btn-outline-primary rounded-pill px-4 py-2 me-2" href="{{ route('auth.login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login Mahasiswa</a></li>
                            <li class="nav-item"><a class="btn btn-primary rounded-pill px-4 py-2" href="{{ route('auth.register') }}"><i class="fas fa-user-plus me-2"></i>Daftar Sekarang</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo ITECH" class="me-2" style="height: 50px; width: auto;">
                            <span class="fw-bold fs-3">ITECH</span>
                        </div>
                        <p class="text-secondary">Institut Teknologi dan Kesehatan</p>
                    </div>
                    <div class="col-md-2 mb-4">
                        <h5 class="fw-bold mb-3">Tautan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('beranda') }}" class="text-secondary text-decoration-none">Beranda</a></li>
                            <li class="mb-2"><a href="{{ route('beranda') }}#program-studi" class="text-secondary text-decoration-none">Program Studi</a></li>
                            <li class="mb-2"><a href="{{ route('beranda') }}#alur" class="text-secondary text-decoration-none">Alur</a></li>
                            <li class="mb-2"><a href="{{ route('beranda') }}#jadwal" class="text-secondary text-decoration-none">Jadwal</a></li>
                            <li class="mb-2"><a href="{{ route('beranda') }}#faq" class="text-secondary text-decoration-none">FAQ</a></li>
                            <li class="mb-2"><a href="{{ route('beranda') }}#kontak" class="text-secondary text-decoration-none">Kontak</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-4">
                        <h5 class="fw-bold mb-3">Kontak</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2 text-secondary"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Jl. Teknologi No. 123, Jakarta</li>
                            <li class="mb-2 text-secondary"><i class="fas fa-phone me-2 text-primary"></i>(021) 1234-5678</li>
                            <li class="mb-2 text-secondary"><i class="fas fa-envelope me-2 text-primary"></i>info@itech.ac.id</li>
                        </ul>
                    </div>
                    <div class="col-md-3 mb-4">
                        <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-secondary fs-4"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-secondary fs-4"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-secondary fs-4"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-secondary fs-4"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="border-secondary">
                <div class="text-center text-secondary">
                    <p class="mb-0">&copy; 2026 ITECH - Institut Teknologi dan Kesehatan. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>