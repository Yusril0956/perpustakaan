<div align="center">
  <img src="public/images/library.svg" alt="Project Logo" width="120">
  <h1>Perpustakaan Digital</h1>
  <p>
    Sistem manajemen perpustakaan berbasis web yang dibangun menggunakan TALL Stack.
  </p>

  <!-- Badges -->
  <div style="margin-top: 12px;">
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Livewire-3-4A5568?style=for-the-badge&logo=php&logoColor=white" alt="Livewire">
    <img src="https://img.shields.io/badge/Tailwind%20CSS-4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  </div>

  <!-- Quick Links -->
  <div style="margin-top: 16px;">
    <a href="#instalasi">
      <img src="https://img.shields.io/badge/Instalasi-547DAB?style=flat&logo=book&logoColor=white" alt="Instalasi">
    </a>
    <a href="#akun-demo">
      <img src="https://img.shields.io/badge/Akun%20Demo-FF6B6B?style=flat&logo=account&logoColor=white" alt="Akun Demo">
    </a>
  </div>
</div>

---

## Daftar Isi

1. [Tentang Project](#tentang-project)
2. [Fitur Utama](#fitur-utama)
3. [Teknologi](#teknologi)
4. [Struktur Project](#struktur-project)
5. [Instalasi](#instalasi)
6. [Menjalankan Aplikasi](#menjalankan-aplikasi)
7. [Akun Demo](#akun-demo)
8. [Lingkup Sistem](#lingkup-sistem)
9. [Kontribusi](#kontribusi)
10. [Lisensi](#lisensi)

---

## Tentang Project

Perpustakaan Digital adalah aplikasi web yang dirancang untuk membantu pengelolaan operasional perpustakaan secara terstruktur dan terdigitalisasi.

Project ini dibuat sebagai tugas sekolah, namun dikembangkan dengan pendekatan sistem nyata. Fokus utama aplikasi ini adalah pada:

- ✅ Pengelolaan inventaris buku
- ✅ Proses peminjaman dengan persetujuan admin
- ✅ Pemantauan status pengembalian
- ✅ Management pengguna dengan role-based access

### Target Pengguna

Aplikasi ini ditujukan untuk skenario penggunaan skala kecil hingga menengah:

| Jenis | Contoh |
|-------|--------|
| 📚 | Perpustakaan sekolah |
| 👥 | Perpustakaan komunitas |
| 🔬 | Laboratorium buku internal |

---

## Fitur Utama

### 🔧 Admin Panel

| Fitur | Deskripsi |
|:------|:----------|
| Dashboard | Statistik jumlah buku, aktivitas peminjaman, ringkasan pengguna |
| Manajemen Buku | CRUD buku, kategori, ISBN, upload cover, pengaturan stok |
| Manajemen Pengguna | CRUD pengguna dengan role: Admin, Staff, Anggota |
| Validasi Peminjaman | Persetujuan dan penolakan pengajuan peminjaman |
| Riwayat Peminjaman | Pencatatan dan pemantauan semua aktivitas |

### 👤 Fitur Anggota (Member)

| Fitur | Deskripsi |
|:------|:----------|
| Katalog Buku | jelajahi dan pencarian buku |
| Kategori | Filter buku berdasarkan kategori |
| Peminjaman | Pengajuan peminjaman buku |
| Wishlist | Menyimpan buku yang diinginkan |
| Riwayat | Melihat riwayat peminjaman |
| Profil | Mengelola profil akun |

### 📊 Fitur Staff

| Fitur | Deskripsi |
|:------|:----------|
| Data Management | Membantu operasional pengelolaan data buku dan anggota |

---

## Teknologi

Aplikasi ini dibangun menggunakan **TALL Stack**:

| Teknologi | Versi | Deskripsi |
|:----------|:------|:----------|
| 🟢 Laravel | 12 | Framework PHP modern |
| ⚡ Livewire | 3 | Full-stack framework untuk Laravel |
| 🔌 Volt | - | Functional JWT untuk Livewire |
| 🎨 Tailwind CSS | 4 | Utility-first CSS framework |
| 🏔️ Alpine.js | - | JavaScript framework ringan |

### Dependensi Tambahan

- **Laravel Breeze** - Autentikasi yang sudah dikustomisasi
- **Spatie Permission** - Role management dan permission
- **Vite** - Asset bundling modern

### Database

Disarankan menggunakan:
- MySQL 8.0+
- PostgreSQL 14+

---

## Instalasi

### Persyaratan Sistem

| Requirement | Versi Minimum |
|:------------|:--------------|
| PHP | 8.2+ |
| Composer | Latest |
| Node.js | 18+ |
| NPM | 9+ |
| Database | MySQL/PostgreSQL |

### Langkah Instalasi

#### 1. Clone Repository

```
bash
git clone https://github.com/yusril0956/perpustakaan.git
cd perpustakaan
```

#### 2. Install Dependencies

```
bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### 3. Konfigurasi Environment

```
bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. Setup Database

```
bash
# Jalankan migrasi dan seeder
php artisan migrate --seed

# Buat symbolic link untuk storage
php artisan storage:link
```

#### 6. Build Assets (Opsional - untuk production)

```
bash
npm run build
```

---

## Menjalankan Aplikasi

### Mode Development

```
bash
# Menggunakan Laravel Artisan (rekomendasi)
composer dev
```

Atau secara manual:

```
bash
# Terminal 1: Jalankan Laravel server
php artisan serve

# Terminal 2: Jalankan Vite dev server
npm run dev
```

### Akses Aplikasi

```
URL: http://localhost:8000
```

---

## Akun Demo

Gunakan kredensial berikut untuk mencoba sistem:

### 👑 Admin Account

| Field | Value |
|:------|:------|
| Email | ryl@test.com |
| Password | password |

### 👤 Member Account

| Field | Value |
|:------|:------|
| Email | member@test.com |
| Password | password |

### 👷 Staff Account

| Field | Value |
|:------|:------|
| Email | staff@test.com |
| Password | password |

---

## Lingkup Sistem

### ✅ Sudah Include

- Sistem autentikasi dan otorisasi
- CRUD lengkap untuk buku dan pengguna
- Sistem peminjaman berbasis persetujuan
- Dashboard untuk admin dan member
- Upload dan management cover buku
- Kategori buku
- Wishlist anggota

### ⚠️ Batasan

- Dirancang untuk penggunaan lokal (localhost)
- Tidak menyediakan API publik
- Belum mendukung deployment production skala besar
- Denda keterlambatan belum dihitung secara otomatis (hanya dicatat)

---

## Catatan Akademik

Project ini dikembangkan sebagai bagian dari tugas sekolah dengan tujuan:

- Memahami arsitektur aplikasi modern berbasis MVC
- Menerapkan role-based access control (RBAC)
- Membangun alur bisnis sederhana berbasis approval workflow
- Mengintegrasikan frontend dan backend dengan Livewire

---

## Lisensi

Project ini menggunakan [MIT License](LICENSE).

---

<div align="center">
  <p>Dibuat dengan ❤️ menggunakan TALL Stack</p>
  <p>&copy; 2024 Perpustakaan Digital</p>
</div>
