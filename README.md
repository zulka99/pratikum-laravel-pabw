# testing_hmvc — Modul 8: HMVC, Authorization, dan AJAX

Aplikasi praktikum Modul 8 (subbab 8.4.5), dibangun di Laravel dengan arsitektur HMVC.

## Stack terpasang

| Komponen | Versi |
|---|---|
| PHP | 8.5.7 (Homebrew) |
| Laravel Framework | 13.39.0 |
| nwidart/laravel-modules | 13.3.0 |
| wikimedia/composer-merge-plugin | 2.1.0 |
| Pest | 4.x (+ pest-plugin-laravel) |
| MySQL/MariaDB (XAMPP) | port 3307 |
| Bootstrap 5.3, Bootstrap Icons 1.11.3, jQuery 3.6 | CDN |

## Menjalankan

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/testing_hmvc
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve --port=8000
```

Buka http://127.0.0.1:8000.

Akun awal dari seeder:

- admin@example.com / password (role Admin)
- user@example.com / password (role User)

## Struktur

- `app/` — authentication di luar HMVC: `Auth/LoginController`, `Auth/RegisterController`,
  `DashboardController`, `Middleware/EnsureUserHasRole`, `Enums/UserRole`, Form Request `Auth/*`.
- `Modules/UserManagement/` — CRUD synchronous khusus admin (`/admin/users`), route `admin.users.*`.
- `Modules/Pendaftaran/` — CRUD AJAX + upload berkas, route `pendaftaran.*`.
- `bootstrap/app.php` — alias middleware `role`, `redirectUsersTo(dashboard)`.
- `routes/web.php` — login, register, logout, dashboard.
- `resources/views/layouts/` — `app`, `guest`, `partials/head`, `partials/scripts`.
- `public/css/theme.css` — tema Bootstrap.
- `tests/Feature/` — 30 pengujian Pest.

## Hak akses

| Halaman | Tamu | User | Admin |
|---|---|---|---|
| Login/Register | Ya | dialihkan ke dashboard | dialihkan ke dashboard |
| Dashboard | ke login | Ya | Ya |
| Pendaftaran (AJAX) | ke login | Ya | Ya |
| Kelola User | ke login | 403 | Ya |

## Pengujian

```bash
php artisan test
```

Hasil: 30 test lulus, 101 assertion (authentication, throttle login, middleware role,
CRUD user, CRUD AJAX, validasi 422, 404, upload/ganti/hapus berkas).

## Catatan lingkungan

- MySQL XAMPP berjalan di port 3307 (port 3306 dipakai Homebrew MySQL 9.6).
  `.env`: `DB_PORT=3307`, database `hmvc_blade`, user `root`, password kosong.
- Apache XAMPP memakai PHP 8.0.28, di bawah syarat Laravel 13 (>= 8.4.1). Karena itu
  aplikasi dijalankan dengan `php artisan serve` (PHP 8.5), bukan lewat
  `http://localhost/testing_hmvc/public`.
- `php artisan serve` membalas 403 untuk berkas di `public/storage` (symlink) karena
  PHP built-in server tidak mengikuti symlink. Berkas tetap tersimpan, terganti, dan
  terhapus dengan benar di `storage/app/public/berkas_pendaftaran` (diuji lewat
  filesystem dan `Storage::fake()`). Untuk membuka berkas lewat URL, jalankan dengan
  Apache yang memakai PHP 8.2+.
- `php artisan install:api` sempat terpanggil tidak sengaja saat scaffolding; paket
  Sanctum, `routes/api.php`, `config/sanctum.php`, dan migration
  `create_personal_access_tokens_table` sudah dihapus supaya sesuai modul.
