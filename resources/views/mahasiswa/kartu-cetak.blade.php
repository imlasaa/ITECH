<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Mahasiswa ITECH - {{ $nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }
        
        .kartu-cetak {
            width: 340px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 15px;
            position: relative;
            overflow: hidden;
            border: 1px solid #dee2e6;
            margin: 0 auto;
        }
        
        .kartu-cetak::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1a2a6c, #b21f1f, #fdbb2d);
        }
        
        .header-card {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .header-card h5 {
            font-size: 14px;
            font-weight: bold;
            color: #0d6efd;
            margin: 0;
        }
        
        .header-card p {
            font-size: 9px;
            color: #6c757d;
            margin: 0;
        }
        
        .badge-status {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #28a745;
            color: white;
            font-size: 8px;
            padding: 2px 6px;
            border-radius: 10px;
        }
        
        .row-custom {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .foto-col {
            width: 90px;
            flex-shrink: 0;
        }
        
        .foto-card {
            width: 90px;
            height: 110px;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .foto-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .data-col {
            flex: 1;
        }
        
        .data-table {
            width: 100%;
            font-size: 9px;
        }
        
        .data-table td {
            padding: 3px 0;
            border: none;
        }
        
        .data-table .label {
            color: #6c757d;
            width: 35%;
        }
        
        .data-table .value {
            font-weight: 600;
            color: #0d6efd;
        }
        
        .info-section {
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px dashed #dee2e6;
            font-size: 7px;
            color: #6c757d;
        }
        
        .footer-card {
            font-size: 6px;
            text-align: center;
            color: #6c757d;
            margin-top: 8px;
            padding-top: 5px;
            border-top: 1px solid #f0f0f0;
        }
        
        /* Container tombol - PERSIS DI BAWAH KARTU */
        .button-container {
            margin-top: 20px;
            text-align: center;
            width: 340px;
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        
        .button-container .btn {
            flex: 1;
            padding: 10px 0;
            font-size: 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .button-container .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        
        .button-container .btn-primary:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }
        
        .button-container .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
        }
        
        .button-container .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
            transform: translateY(-2px);
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .kartu-cetak {
                box-shadow: none;
                border: 1px solid #000;
                page-break-after: always;
            }
            
            .button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Kartu -->
    <div class="kartu-cetak">
        <!-- Badge Status -->
        <div class="badge-status">AKTIF</div>
        
        <!-- Header -->
        <div class="header-card">
            <h5>ITECH</h5>
            <p>Institut Teknologi dan Kesehatan</p>
        </div>
        
        <!-- Layout Landscape -->
        <div class="row-custom">
            <!-- Foto -->
            <div class="foto-col">
                <div class="foto-card">
                    @if($pasFoto)
                        <img src="{{ asset('storage/' . $pasFoto) }}" alt="Pas Foto">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <i class="fas fa-user fa-2x text-secondary"></i>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Data -->
            <div class="data-col">
                <table class="data-table">
                    <tr>
                        <td class="label">NIM</td>
                        <td class="value">{{ $nim }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nama</td>
                        <td class="value">{{ $nama }}</td>
                    </tr>
                    <tr>
                        <td class="label">Program Studi</td>
                        <td class="value">{{ $programStudi }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tahun Masuk</td>
                        <td class="value">{{ $tahunMasuk }}</td>
                    </tr>
                    <tr>
                        <td class="label">Masa Berlaku</td>
                        <td class="value">{{ $tahunMasuk }} - {{ $masaBerlaku }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- Informasi Tambahan -->
        <div class="info-section">
            <div class="d-flex justify-content-between">
                <span><i class="fas fa-check-circle text-success"></i> Status: Mahasiswa Aktif</span>
                <span><i class="fas fa-calendar-alt text-primary"></i> Terdaftar: {{ $tahunMasuk }}</span>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer-card">
            Kartu ini adalah milik ITECH • Jika ditemukan, harap kembalikan
        </div>
    </div>
    
    <!-- Tombol Cetak dan Kembali - PERSIS DI BAWAH KARTU -->
    <div class="button-container">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print me-2"></i>Cetak Kartu
        </button>
        <a href="{{ route('mahasiswa.kartu') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
    
    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>