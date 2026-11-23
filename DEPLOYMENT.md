# Panduan Deployment & Hosting - Ranah Rengkuh (Rengkuhan)

Website **Ranah Rengkuh** kini sudah lengkap, rapi, dan siap dideploy ke shared hosting (cPanel/DirectAdmin) atau VPS (Laravel Forge, Coolify, DigitalOcean, Ubuntu Nginx).

---

## 1. Akun Bawaan (Default Seed Data)

Aplikasi telah dilengkapi seeder akun untuk uji coba langsung:

| Role | Email Login | Password | Akses Dashboard |
|---|---|---|---|
| **Administrator** | `admin@rengkuhan.org` | `admin12345` | `/dashboard/admin` |
| **Pengurus (Mandala)** | `pengurus@rengkuhan.org` | `pengurus12345` | `/dashboard/pengurus` |
| **Volunteer (Relawan)** | `volunteer@rengkuhan.org` | `volunteer12345` | `/dashboard/volunteer` |

> *Catatan: Jangan lupa ubah password di atas pada database produksi Anda saat sudah live.*

---

## 2. Fitur Utama yang Siap Digunakan

1. **Volunteer Portal**:
   - Pendaftaran akun baru & masuk login.
   - Melihat kegiatan terbuka real-time dari database lengkap dengan kuota relawan.
   - Pendaftaran ke kegiatan dengan validasi kuota otomatis.
   - Konfirmasi pembayaran & metode kontribusi (QRIS, BCA, Mandiri, E-Wallet).
   - Pembaruan profil (Nama & No. WhatsApp).

2. **Pengurus (Mandala) Portal**:
   - Pembuatan dan pengelolaan jadwal kegiatan (CRUD).
   - Penyusunan Rencana Anggaran Biaya (RAB) per kegiatan dengan perhitungan subtotal otomatis.
   - Verifikasi status kontribusi/pembayaran pendaftar (Setujui / Tolak).

3. **Administrator Portal**:
   - Pembuatan & penghapusan akun pengurus/administrator.
   - Monitoring & manajemen data relawan.
   - Pengelolaan Chart of Accounts (COA) akuntansi.
   - Rekap ringkas total kas masuk.

---

## 3. Langkah-langkah Hosting di cPanel (Shared Hosting)

1. **Persiapan Database**:
   - Buat database MySQL baru dan buat user database di cPanel -> **MySQL Databases**.
   - Berikan hak akses penuh (All Privileges) user ke database tersebut.
   - Buka **phpMyAdmin** di cPanel, lalu import database dari lokal atau jalankan migrasi.

2. **Upload Berkas Aplikasi**:
   - Compress seluruh file project ke dalam file `.zip` (kecuali folder `node_modules` dan cache).
   - Di File Manager cPanel, buat folder di luar `public_html` (misal: `/home/username/rengkuhan_app/`) dan ekstrak berkas di sana.
   - Pindahkan seluruh isi folder `public/` milik project ke dalam folder `public_html/`.
   - Edit file `public_html/index.php` dan sesuaikan path autoload-nya:
     ```php
     require __DIR__.'/../rengkuhan_app/vendor/autoload.php';
     $app = require_once __DIR__.'/../rengkuhan_app/bootstrap/app.php';
     ```

3. **Pengaturan `.env` di Server**:
   - Ubah parameter database:
     ```env
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://namadomainanda.com

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nama_database_cpanel
     DB_USERNAME=nama_user_cpanel
     DB_PASSWORD=password_database_cpanel
     ```
   - Jalankan perintah optimize melalui Terminal cPanel (atau SSH):
     ```bash
     php artisan migrate --force
     php artisan db:seed --force
     php artisan optimize
     ```

4. **Selesai!** Website Ranah Rengkuh siap menerima relawan!
