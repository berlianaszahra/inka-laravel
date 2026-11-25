# INKA — Ruang Belajar untuk UMKM dan Kreator

**INKA** adalah proyek akhir Praktikum Pemrograman Web Kelompok 4 PTI C. Aplikasi ini membantu pelaku UMKM dan pekerja kreatif pemula mempelajari **Hak Kekayaan Intelektual (HKI)** dan **Harga Pokok Produksi (HPP)** melalui materi ringkas dan kuis interaktif.

## Fitur yang Sudah Tersedia

| Fitur | Yang bisa dicoba |
| --- | --- |
| Landing Page | Mengenal INKA, melihat fitur, dan membuka halaman Masuk atau Daftar |
| Registrasi dan Login | Membuat akun, masuk dengan akun yang terdaftar, dan keluar |
| Lupa Password | Membuka form email dan melihat popup konfirmasi simulasi |
| Dashboard Pengguna | Melihat sapaan akun dan mengakses fitur dari menu pengguna |
| Profil Pengguna | Melihat nama dan email akun serta menyimpan perubahan nama |
| Kuis HAKI dan HPP | Memilih kategori dan submateri, membaca materi, menjawab 10 soal, serta melihat skor dan ulasan jawaban |

Setiap kategori kuis memiliki tiga submateri dan satu paket latihan berisi 10 soal. Skor dihitung di browser dan belum tersimpan di riwayat akun. Fitur Lupa Password masih berupa simulasi, sehingga belum mengirim tautan melalui email.

## Teknologi

- **Laravel** dan **PHP** untuk routing, autentikasi, dan pengelolaan data akun
- **Blade** untuk halaman aplikasi
- **Tailwind CSS** untuk styling dan layout responsif
- **Vite** untuk membangun aset CSS dan JavaScript
- **Figma** untuk desain antarmuka

## Cara Menjalankan di Localhost

Siapkan **PHP 8.4**, **Composer**, **Node.js 22.12+**, dan **npm**.

### 1. Clone dan instal dependensi

```bash
git clone https://github.com/berlianaszahra/inka-laravel.git
cd inka-laravel

composer install
npm install
```

### 2. Siapkan konfigurasi lokal

Untuk instalasi baru, salin `.env.example` jika `.env` belum ada, lalu buat application key:

```bash
test -f .env || cp .env.example .env
php artisan key:generate
```

Untuk memakai **SQLite**, atur `DB_CONNECTION=sqlite` di `.env` dan hapus pengaturan `DB_DATABASE` lama jika sebelumnya menunjuk ke MySQL. Lalu jalankan:

```bash
touch database/database.sqlite
php artisan migrate
```

Kalau tim memakai **MySQL**, buat database lokal, isi pengaturan `DB_*` di `.env` sesuai database kamu, lalu jalankan `php artisan migrate`. Simpan `.env` di laptop masing-masing.

### 3. Build dan jalankan aplikasi

```bash
npm run build
php artisan serve
```

Buka [http://127.0.0.1:8000](http://127.0.0.1:8000) di browser. Jalankan `npm run build` lagi setelah mengubah styling atau menambah class Tailwind.

## Alur Demo

1. Buka **Landing Page**, klik **Daftar**, lalu buat akun.
2. **Masuk** dengan akun tersebut untuk membuka Dashboard.
3. Buka **Profil Saya**, ubah nama, lalu kembali ke Dashboard untuk melihat perubahan.
4. Pilih **Mulai Kuis → HAKI atau HPP → Baca Materi → Mulai 10 Soal**.
5. Jawab semua soal, klik **Kumpulkan Kuis**, lalu buka **Lihat Pembahasan**.

## Struktur File

| Lokasi | Isi |
| --- | --- |
| `routes/web.php` | Route halaman dan aksi pengguna |
| `resources/views/auth/` | Halaman Login, Register, dan Lupa Password |
| `resources/views/dashboard.blade.php` | Dashboard pengguna |
| `resources/views/profile.blade.php` | Profil dan form edit nama |
| `resources/views/quiz.blade.php` | Pilihan kategori dan daftar submateri |
| `resources/views/quiz-lesson.blade.php` | Materi, soal, hasil, dan ulasan jawaban |
| `config/quiz.php` | Bank soal dan kunci jawaban |
| `public/images/inka/` | Logo, ikon, dan ilustrasi INKA |

## Kolaborasi Tim

Setiap anggota mengerjakan bagiannya di branch fitur, misalnya `feat/kalkulator-hpp` atau `feat/panduan-hki`. Setelah diuji di localhost, push ke branch tersebut dan buat **Pull Request** ke `main` untuk direview.

[Desain antarmuka INKA di Figma](https://www.figma.com/design/UQoIhtMZ1T35yCdiyrifWY/fix-inka---mcp?node-id=54-6955)

halo 