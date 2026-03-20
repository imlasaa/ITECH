# 🎓 ITECH PMB - Sistem Penerimaan Mahasiswa Baru

**Institut Teknologi dan Kesehatan (ITECH)**  
Sistem Penerimaan Mahasiswa Baru berbasis Laravel dengan fitur lengkap untuk seleksi online.

![Laravel Version](https://img.shields.io/badge/Laravel-11-red)
![PHP Version](https://img.shields.io/badge/PHP-8.3-blue)
![MySQL Version](https://img.shields.io/badge/MySQL-8.0-orange)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📋 Fitur Utama

### 👨‍🎓 **Mahasiswa**
- ✅ Registrasi Akun dengan **Nomor Tes** otomatis
- ✅ Login dengan **Nomor Tes + Password**
- ✅ Pengisian **Data Pribadi** (opsional)
- ✅ **Ujian Online** dengan timer 30 menit
- ✅ Navigasi soal dengan 5 opsi jawaban
- ✅ Hasil ujian (menunggu verifikasi admin)
- ✅ **Daftar Ulang** dengan upload berkas (opsional)
- ✅ **Generate NIM** otomatis setelah verifikasi admin
- ✅ **Kartu Mahasiswa** dengan QR Code (bisa dicetak)
- ✅ **Lupa Nomor Tes** dengan verifikasi password

### 👨‍💼 **Admin**
- ✅ Login dengan **Email + Password**
- ✅ Dashboard dengan statistik real-time
- ✅ **CRUD Calon Mahasiswa**
- ✅ **Manajemen Soal Ujian** (CRUD)
- ✅ **Kelulusan** dengan Accept/Reject
- ✅ **Verifikasi Daftar Ulang** + Generate NIM otomatis
- ✅ Download file berkas mahasiswa
- ✅ Filter data berdasarkan prodi, status, dan pencarian

---

## 🛠️ Tech Stack

| Teknologi | Keterangan |
|-----------|------------|
| **Laravel 11** | Framework PHP |
| **PHP 8.3** | Bahasa Pemrograman |
| **MySQL** | Database |
| **Bootstrap 5** | Frontend Framework |
| **SweetAlert2** | Notifikasi interaktif |
| **Font Awesome 6** | Icon library |
| **Simple QR Code** | Generate QR Code kartu |

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.3+
- Composer
- MySQL
- Node.js & NPM

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/USERNAME/ITECH.git
cd ITECH

# 2. Install dependencies
composer install
npm install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
DB_DATABASE=itech
DB_USERNAME=root
DB_PASSWORD=

# 6. Jalankan migration & seeder
php artisan migrate
php artisan db:seed

# 7. Link storage untuk upload file
php artisan storage:link

# 8. Build assets
npm run build

# 9. Jalankan server
php artisan serve