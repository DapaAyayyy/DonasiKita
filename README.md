# DonasiKita

**DonasiKita** adalah aplikasi web penggalangan dana/donasi berbasis Laravel yang dibuat untuk proyek mata kuliah Rekayasa Perangkat Lunak. Aplikasi ini bertujuan untuk memfasilitasi proses donasi sosial secara lebih transparan, terstruktur, dan mudah digunakan oleh donatur maupun admin.

---

## Deskripsi Singkat

DonasiKita adalah platform crowdfunding sederhana yang memungkinkan pengguna melihat kampanye donasi, melakukan donasi, melihat riwayat donasi, serta melihat leaderboard donatur. Admin dapat mengelola kampanye, mengelola data donasi, dan melakukan verifikasi pembayaran donasi.

Pada tahap pengembangan ini, sistem menggunakan metode pembayaran simulasi/manual dan belum terintegrasi dengan payment gateway asli.

---

## Role Pengguna

### 1. Admin

Admin memiliki akses untuk:

- Login ke dashboard admin
- Mengelola data kampanye
- Mengelola data donatur
- Melihat riwayat donasi
- Memverifikasi donasi
- Mengelola akun admin
- Melihat data leaderboard

### 2. Donatur

Donatur memiliki akses untuk:

- Registrasi akun
- Login ke sistem
- Melihat daftar kampanye
- Melihat detail kampanye
- Melakukan donasi
- Melihat riwayat donasi
- Mengelola profil
- Melihat leaderboard

---

## Tech Stack

Project ini menggunakan stack berikut:

- **Backend:** PHP + Laravel
- **Template Engine:** Laravel Blade
- **Styling:** Tailwind CSS
- **Asset Bundler:** Vite
- **Database:** MySQL
- **Local Development:** Laragon
- **Package Manager PHP:** Composer
- **Package Manager Frontend:** NPM
- **Version Control:** Git & GitHub

---

## Fitur Utama

Fitur utama yang direncanakan:

- Login dan register
- Role Admin dan Donatur
- Landing page
- Daftar kampanye
- Detail kampanye
- CRUD kampanye oleh Admin
- Donasi/pembayaran
- Verifikasi donasi oleh Admin
- Riwayat donasi
- Leaderboard donatur
- Profil donatur
- Dashboard Admin
- Dashboard Donatur

---

## Cara Setup Project

Ikuti langkah-langkah berikut setelah melakukan clone repository.

### 1. Clone Repository

```bash
git clone <url-repository>
cd donasikita
```

Jika repository sudah pernah di-clone, cukup jalankan:

```bash
git pull origin main
```

> Sesuaikan `main` dengan nama branch yang digunakan.

---

### 2. Install Dependency Laravel

```bash
composer install
```

Command ini akan membuat folder:

```txt
vendor/
```

---

### 3. Install Dependency Frontend

```bash
npm install
```

Command ini akan membuat folder:

```txt
node_modules/
```

---

### 4. Buat File Environment

Untuk Windows Command Prompt:

```cmd
copy .env.example .env
```

Untuk Git Bash / Linux / macOS:

```bash
cp .env.example .env
```

Untuk PowerShell:

```powershell
Copy-Item .env.example .env
```

---

### 5. Generate Application Key

```bash
php artisan key:generate
```

Pastikan pada file `.env` terdapat nilai:

```env
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxx
```

---

## Setup Database dengan Laragon

Project ini menggunakan MySQL dari Laragon.

### 1. Jalankan Laragon

Buka Laragon, lalu klik:

```txt
Start All
```

Pastikan service MySQL sudah berjalan.

---

### 2. Buat Database

Buat database baru dengan nama:

```txt
crowdfunding
```

Atau sesuaikan dengan nama database yang digunakan oleh tim.

---

### 3. Import Database Dummy

Import file `.sql` database dummy melalui:

- HeidiSQL
- phpMyAdmin
- Adminer
- MySQL client lain

Pastikan tabel dan data dummy berhasil masuk ke database.

---

### 4. Konfigurasi `.env`

Buka file `.env`, lalu sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=crowdfunding
DB_USERNAME=root
DB_PASSWORD=
```

> Catatan: Pada beberapa instalasi Laragon, port MySQL bisa menggunakan `3306` atau `3308`. Sesuaikan `DB_PORT` dengan port MySQL yang aktif di perangkat masing-masing.

---

### 5. Konfigurasi Cache dan Session

Agar tidak error karena tabel `cache` belum tersedia, gunakan konfigurasi berikut:

```env
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

Jika pada `.env` masih terdapat:

```env
CACHE_STORE=database
```

ubah menjadi:

```env
CACHE_STORE=file
```

---

### 6. Clear Config Laravel

Setelah mengubah `.env`, jalankan:

```bash
php artisan config:clear
```

Jika diperlukan:

```bash
php artisan cache:clear
```

---

## Menjalankan Project

Jalankan server Laravel:

```bash
php artisan serve
```

Lalu jalankan Vite:

```bash
npm run dev
```

Buka aplikasi di browser:

```txt
http://127.0.0.1:8000
```

---

## Tes Koneksi Database

Untuk memastikan Laravel sudah terhubung ke database, jalankan:

```bash
php artisan tinker
```

Lalu jalankan:

```php
DB::select('SHOW TABLES');
```

Jika daftar tabel muncul, berarti koneksi database berhasil.

Untuk keluar dari tinker:

```php
exit
```

---

## Route Testing Awal

Jika backend sudah membuat route test, akses:

```txt
http://127.0.0.1:8000/test-campaigns
```

Target:

- Menampilkan data campaign/kampanye dalam bentuk JSON
- Data berasal dari database MySQL

Jika halaman campaign sudah dibuat, akses:

```txt
http://127.0.0.1:8000/campaigns
```

Target:

- Menampilkan daftar kampanye dari database
- Data tidak hardcode

---

## Catatan Penting

Jangan menjalankan command berikut sembarangan:

```bash
php artisan migrate:fresh
```

Command tersebut akan menghapus semua tabel dan data dummy di database.

Gunakan hanya jika sudah disepakati oleh tim.

---

## Troubleshooting

### 1. Error `vendor/autoload.php not found`

Penyebab:

- Dependency Composer belum diinstall.

Solusi:

```bash
composer install
```

---

### 2. Error `No application encryption key has been specified`

Penyebab:

- Belum menjalankan generate key.

Solusi:

```bash
php artisan key:generate
```

---

### 3. Error database tidak terkoneksi

Cek file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=crowdfunding
DB_USERNAME=root
DB_PASSWORD=
```

Pastikan:

- Laragon sudah `Start All`
- MySQL berjalan
- Nama database benar
- Port database benar
- Username/password sesuai

---

### 4. Error `Table 'crowdfunding.cache' doesn't exist`

Penyebab:

- Laravel menggunakan database sebagai cache store.
- Tabel `cache` belum tersedia.

Solusi:

Ubah `.env`:

```env
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

Lalu jalankan:

```bash
php artisan config:clear
```

---

### 5. Error `Unknown column updated_at`

Penyebab:

- Laravel menganggap tabel punya kolom `created_at` dan `updated_at`.
- Tabel database tidak memiliki kolom tersebut.

Solusi:

Tambahkan di model terkait:

```php
public $timestamps = false;
```

---

### 6. Error `Table not found`

Penyebab:

- Nama tabel di model tidak sesuai dengan nama tabel di database.

Solusi:

Cek nama tabel di database, lalu tambahkan pada model:

```php
protected $table = 'nama_tabel';
```

Contoh:

```php
protected $table = 'kampanye';
```

---

## Workflow Tim

### Backend

Fokus:

- Setup koneksi database
- Model dan relasi
- Controller
- Route
- Auth dan role
- Donasi dan verifikasi
- Leaderboard
- Dashboard admin/donatur

### Frontend

Fokus:

- Low-fidelity dan high-fidelity
- Slicing Blade dari Figma
- Layout utama
- Navbar dan footer
- Card kampanye
- Form donasi
- Dashboard
- Leaderboard

### Project Manager

Fokus:

- Mengelola Trello/task board
- Membagi tugas
- Memantau progress
- Menjaga komunikasi frontend-backend
- Menyusun dokumentasi
- Menyiapkan alur demo

---

## Roadmap Singkat

### Tahap 1 — Setup

- Project Laravel bisa dijalankan
- Database dummy berhasil di-import
- Laravel berhasil connect ke MySQL
- Data kampanye tampil dari database

### Tahap 2 — Fitur Inti

- Login/register
- Role admin dan donatur
- Campaign list dan detail
- CRUD campaign oleh admin
- Donasi
- Verifikasi donasi
- Riwayat donasi
- Leaderboard

### Tahap 3 — Finishing

- Integrasi UI dari Figma
- Testing alur demo
- Fix bug
- Rapikan README
- Update laporan RPL
- Siapkan presentasi/demo

---

## Alur Demo Target

Alur demo minimal yang harus bisa berjalan:

```txt
1. Donatur membuka homepage
2. Donatur melihat daftar kampanye
3. Donatur register/login
4. Donatur memilih kampanye
5. Donatur melakukan donasi
6. Donasi masuk dengan status pending
7. Admin login
8. Admin memverifikasi donasi
9. Dana terkumpul bertambah
10. Leaderboard berubah
11. Donatur melihat riwayat donasi
```

---

## Akun Dummy

Isi bagian ini jika akun dummy sudah tersedia.

### Admin

```txt
Email    : admin@example.com
Password : password
```

### Donatur

```txt
Email    : donatur@example.com
Password : password
```

> Catatan: Sesuaikan akun dummy dengan data yang ada di database masing-masing.

---

## Referensi

Beberapa referensi konsep platform donasi:

- GoFundMe
- Kitabisa
- Amalsholeh
- Ayobantu

---

## Tim Pengembang

Kelompok 7 — Rekayasa Perangkat Lunak

| Nama | Role |
|---|---|
| Ahmad Dzaki Fadlurrahman | Back End |
| Fariz Akhadi | Back End |
| Daffa Azmi Ikhtiar Fadhil | Project Manager |
| Muhammad Syarif Sabiqul Khoir | Front End |
| Muhammad Rafa Fathurrahim | Front End |

---

## Status Project

Project saat ini berada pada tahap awal pengembangan.

Prioritas terdekat:

- Menyambungkan Laravel ke database MySQL
- Menampilkan data dummy dari database
- Membuat struktur route dan controller awal
- Melanjutkan implementasi fitur inti DonasiKita
