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
| Muhammad Syarif Sabiqul Khoir | Front End 2|
| Muhammad Rafa Fathurrahim | Front End 1|

---

## Status Project

Project saat ini berada pada tahap awal pengembangan.

Prioritas terdekat:

- Menyambungkan Laravel ke database MySQL
- Menampilkan data dummy dari database
- Membuat struktur route dan controller awal
- Melanjutkan implementasi fitur inti DonasiKita
