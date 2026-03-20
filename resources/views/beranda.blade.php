@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <section id="beranda" class="py-5 min-vh-100 d-flex align-items-center">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-3 fw-bold mb-4">Selamat Datang di <span class="text-primary">ITECH</span></h1>
                <p class="lead text-secondary mb-4">Institut Teknologi dan Kesehatan - Mempersiapkan generasi unggul untuk masa depan melalui pendidikan berkualitas dan inovatif.</p>
                <div class="d-flex gap-3">
                    <a href="/auth/register" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="#program-studi" class="btn btn-outline-primary btn-lg px-5 py-3 rounded-pill">
                        <i class="fas fa-graduation-cap me-2"></i>Lihat Program Studi
                    </a>
                </div>
                
             
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/gedung.jpg') }}" alt="Hero Image" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </section>

    <!-- Program Studi Section -->
    <section id="program-studi" class="py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Program Studi</h2>
            <p class="text-secondary fs-5">Pilih program studi yang sesuai dengan minat dan bakat Anda</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-code fa-3x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Teknik Informatika</h4>
                        <p class="text-secondary">Program studi yang fokus pada pengembangan perangkat lunak, kecerdasan buatan, dan teknologi informasi terkini.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-database fa-3x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sistem Informasi</h4>
                        <p class="text-secondary">Mempelajari analisis, perancangan, dan implementasi sistem informasi untuk mendukung proses bisnis.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body text-center p-4">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-heartbeat fa-3x"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Kesehatan Masyarakat</h4>
                        <p class="text-secondary">Program studi yang mempersiapkan tenaga profesional di bidang kesehatan masyarakat dan promosi kesehatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran -->
    <section id="alur" class="py-5 bg-white rounded-4 shadow-sm p-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Alur Pendaftaran</h2>
            <p class="text-secondary fs-5">Ikuti langkah-langkah berikut untuk menjadi mahasiswa ITECH</p>
        </div>
        
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="text-center position-relative">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-2 fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold">Registrasi Akun</h5>
                    <p class="text-secondary">Buat akun dengan mengisi data diri</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center position-relative">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-2 fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold">Isi Data Pribadi</h5>
                    <p class="text-secondary">Lengkapi data diri dan pilih program studi</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center position-relative">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-2 fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold">Ikuti Ujian</h5>
                    <p class="text-secondary">Kerjakan soal ujian online</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-2 fw-bold">4</span>
                    </div>
                    <h5 class="fw-bold">Daftar Ulang</h5>
                    <p class="text-secondary">Jika lulus, lakukan daftar ulang</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Penting -->
    <section id="jadwal" class="py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Jadwal Penting</h2>
            <p class="text-secondary fs-5">Catat tanggal-tanggal penting berikut</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="p-3">Kegiatan</th>
                                <th class="p-3">Tanggal Mulai</th>
                                <th class="p-3">Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 fw-semibold">Pendaftaran</td>
                                <td class="p-3">1 Maret 2026</td>
                                <td class="p-3">30 Maret 2026</td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-semibold">Ujian Seleksi</td>
                                <td class="p-3">5 April 2026</td>
                                <td class="p-3">7 April 2026</td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-semibold">Pengumuman</td>
                                <td class="p-3">15 April 2026</td>
                                <td class="p-3">15 April 2026</td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-semibold">Daftar Ulang</td>
                                <td class="p-3">16 April 2026</td>
                                <td class="p-3">30 April 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-5 bg-white rounded-4 shadow-sm p-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
            <p class="text-secondary fs-5">Pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion" id="accordionFAQ">
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Bagaimana cara mendaftar?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Klik tombol "Daftar Sekarang" di pojok kanan atas, isi form registrasi dengan nama lengkap, email, pilih program studi, dan buat password. Setelah berhasil, Anda akan mendapatkan nomor tes yang digunakan untuk login.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah ujiannya online?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Ya, seluruh proses ujian dilakukan secara online melalui website ini. Anda akan mengerjakan soal dengan durasi 30 menit dan 5 pilihan jawaban.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Kapan pengumuman kelulusan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Pengumuman akan diumumkan pada tanggal 15 April 2026 melalui dashboard masing-masing mahasiswa.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apa saja berkas yang perlu disiapkan untuk daftar ulang?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Berkas yang diperlukan: Surat Pernyataan, Pas Foto 3x4, Surat Keterangan Sehat, dan Kartu Keluarga. 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Hubungi Kami</h2>
            <p class="text-secondary fs-5">Jika ada pertanyaan, jangan ragu untuk menghubungi kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Alamat</h5>
                    <p class="text-secondary mb-0">Jl. Teknologi No. 123, Jakarta</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-phone fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Telepon</h5>
                    <p class="text-secondary mb-0">(021) 1234-5678</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Email</h5>
                    <p class="text-secondary mb-0">info@itech.ac.id</p>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- AOS Animation CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
</style>
@endsection