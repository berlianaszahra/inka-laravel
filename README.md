# INKA — Ruang Belajar HKI & HPP untuk UMKM dan Kreator

**INKA** adalah aplikasi web berbasis **Laravel** yang dirancang sebagai ruang belajar interaktif bagi **UMKM** dan **pekerja kreatif pemula** untuk memahami **Hak Kekayaan Intelektual (HKI)** serta menghitung **Harga Pokok Produksi (HPP)** secara praktis.

> Proyek Akhir Praktikum Pemrograman Web — **Kelompok 4 PTI C**

---

## Fitur Utama

1. **Landing Page & Autentikasi Pengguna**
   - Halaman beranda informatif mengenai manfaat HKI dan pengelolaan biaya produksi.
   - Registrasi akun baru, Login, Logout, pembaruan nama profil, serta simulasi Lupa Password.
   - Pembatasan percobaan (*rate limiting*) pada endpoint autentikasi dan pengiriman pertanyaan bantuan.

2. **Dashboard Pengguna**
   - Ringkasan progres belajar dan akses cepat ke 6 modul utama INKA dalam satu tampilan terpadu.

3. **Pusat Edukasi HKI (`/edukasi`)**
   - Tiga topik pembelajaran interaktif: **Mengenal Kekayaan Intelektual (`dasar-hki`)**, **Perlindungan Merek (`merek`)**, dan **Hak Cipta atas Karya Kreatif (`hak-cipta`)**.
   - Setiap materi disusun dalam 3 tahap terstruktur: **Kenali Konsep**, **Contoh Kasus**, dan **Latihan Singkat** dengan umpan balik langsung.

4. **Panduan Pendaftaran HKI (`/panduan`)**
   - Alur langkah demi langkah untuk tahap **Persiapan**, **Pengajuan**, dan **Pemantauan** pendaftaran HKI beserta daftar dokumen yang dibutuhkan.

5. **Kalkulator & Riwayat HPP (`/calculator` & `/riwayat-hpp`)**
   - Perhitungan total biaya produksi (bahan baku, tenaga kerja, overhead) dan HPP per unit.
   - Penyimpanan sementara ke riwayat sesi, pencarian produk, filter 7 hari terakhir, serta tampilan ringkasan laporan HPP.

6. **Kuis Interaktif HAKI & HPP (`/quiz`)**
   - Kategori **HAKI** dan **HPP**, masing-masing terdiri dari 3 submateri dengan mode baca materi dan latihan 10 soal pilihan ganda beserta skor dan pembahasan.

7. **Pusat Bantuan & FAQ (`/faq`)**
   - Daftar pertanyaan yang sering diajukan beserta halaman detail jawaban.
   - Formulir pengajuan pertanyaan bantuan dengan validasi input dan halaman konfirmasi pengiriman.

8. **Panel Konten Admin (`/admin`)**
   - Pengelolaan konten oleh akun dengan hak akses `access-admin`.

---

## Teknologi yang Digunakan

- **Backend:** PHP 8.4+, Laravel
- **Frontend:** Blade Template, Tailwind CSS, Vite
- **Database:** SQLite / MySQL
- **Deployment Config:** Docker (`Dockerfile.vercel`), Caddy (`Caddyfile`), Vercel (`vercel.json`)

---

## Struktur Direktori Penting

```text
inka-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminContentController.php   # CRUD konten admin
│   │   └── AuthController.php           # Registrasi, login, dan update profil
│   └── Models/
│       ├── AdminContent.php
│       └── User.php
├── config/
│   └── quiz.php                         # Bank materi dan soal kuis HAKI & HPP
├── database/
│   └── migrations/                      # Skema tabel users, cache, jobs, dan admin_content
├── public/images/inka/                  # Aset ilustrasi dan ikon SVG per modul
├── resources/views/
│   ├── admin/index.blade.php            # Halaman kelola konten admin
│   ├── auth/                            # Halaman login, register, forgot-password
│   ├── calculator.blade.php             # Kalkulator HPP
│   ├── dashboard.blade.php              # Dashboard utama pengguna
│   ├── education.blade.php              # Pusat Edukasi HKI (daftar topik & 3 tahap belajar)
│   ├── faq.blade.php                    # Bantuan, detail jawaban, & form ajukan pertanyaan
│   ├── guide.blade.php                  # Panduan pendaftaran HKI
│   ├── hpp-history.blade.php            # Riwayat & laporan perhitungan HPP
│   ├── profile.blade.php                # Pengaturan profil pengguna
│   ├── quiz.blade.php                   # Halaman kategori, materi, & soal kuis
│   └── welcome.blade.php                # Landing page publik
└── routes/
    └── web.php                          # Definisi seluruh rute aplikasi
```

---

## Daftar Rute Utama

| Metode | URL | Nama Rute | Keterangan |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | — | Landing page aplikasi |
| `GET` / `POST` | `/register` | `register` / `register.store` | Pendaftaran akun baru |
| `GET` / `POST` | `/login` | `login` / `login.store` | Masuk ke akun pengguna |
| `GET` | `/dashboard` | `dashboard` | Dashboard pengguna *(wajib login)* |
| `GET` / `PATCH` | `/profile` | `profile.show` / `profile.update` | Lihat & ubah nama profil *(wajib login)* |
| `GET` | `/edukasi` | `education.index` | Daftar topik Pusat Edukasi HKI |
| `GET` | `/edukasi/{topic}?step=...` | `education.lesson` | Materi edukasi (`konsep`, `kasus`, `latihan`) |
| `GET` | `/panduan/{langkah?}` | `guide.index` | Panduan HKI (`persiapan`, `pengajuan`, `pemantauan`) |
| `GET` / `POST` | `/calculator` | `calculator.index` / `calculator.calculate` | Kalkulator perhitungan HPP |
| `GET` | `/riwayat-hpp` | `hpp.history` | Daftar riwayat perhitungan HPP |
| `GET` | `/quiz` | `quiz.index` | Halaman utama Kuis HAKI & HPP |
| `GET` | `/quiz/{category}/{topic}/materi` | `quiz.material` | Baca materi subtopik kuis *(wajib login)* |
| `GET` | `/quiz/{category}/{topic}/soal` | `quiz.play` | Kerjakan soal kuis *(wajib login)* |
| `GET` | `/faq` | `faq.index` | Daftar FAQ & Pusat Bantuan |
| `GET` / `POST` | `/faq/ajukan` | `faq.ask` / `faq.send` | Formulir ajukan pertanyaan bantuan |

---

## Panduan Instalasi & Menjalankan di Lokal

### Prasyarat
- **PHP** `>= 8.4`
- **Composer**
- **Node.js** `>= 22.12` & **npm**

### Langkah Instalasi

1. **Clone repository dan masuk ke direktori proyek**
   ```bash
   git clone https://github.com/berlianaszahra/inka-laravel.git
   cd inka-laravel
   ```

2. **Install dependensi PHP dan JavaScript**
   ```bash
   composer install
   npm install
   ```

3. **Salin konfigurasi environment dan buat application key**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Siapkan database dan jalankan migrasi**
   Jika menggunakan SQLite (default Laravel):
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```
   *(Jika menggunakan MySQL, sesuaikan pengaturan `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env` terlebih dahulu).*

5. **Build aset frontend dan jalankan server lokal**
   ```bash
   npm run build
   php artisan serve
   ```
   Buka aplikasi di browser melalui `http://127.0.0.1:8000`.

---

## Catatan Pengembangan

- Apabila mengubah file rute atau tampilan Blade, bersihkan cache Laravel dengan:
  ```bash
  php artisan route:clear
  php artisan view:clear
  ```
- Saat ini penyimpanan riwayat HPP dan pengerjaan kuis berjalan berbasis sesi/browser, sedangkan fitur *Lupa Password* dan *Notifikasi* menggunakan antarmuka simulasi.