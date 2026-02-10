<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

````markdown
# Masjid Web - Laravel Project

Halo! Ini adalah project website untuk Masjid Baitussalam.
````
---

## 1. Clone repository

Kalau ingin clone dari branch tertentu (misal `backend`), jalankan perintah ini:

````bash
git clone -b backend --single-branch https://github.com/LegarSuryantara/baitussalam-website.git masjid_web
````

> Keterangan:
>
> * `-b backend` → memilih branch yang ingin diclone (ganti kalau mau branch lain).
> * `masjid_web` → nama folder yang akan dibuat untuk project.

Masuk ke folder project:

```bash
cd masjid_web
```

---

## 2. Install dependencies PHP

Laravel membutuhkan Composer untuk mengelola library PHP. Jalankan:

```bash
composer install
```

> Pastikan Composer sudah terinstall.

---

## 3. Setup file environment

File `.env` berisi konfigurasi project, seperti database. Copy dulu file contoh:

```bash
cp .env.example .env
```

Kemudian buka `.env` dan edit bagian database, contohnya:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

> Ganti `nama_database` sesuai database yang sudah kamu buat di MySQL/MariaDB.

---

## 4. Generate application key

Laravel membutuhkan key untuk keamanan. Jalankan:

```bash
php artisan key:generate
```

---

## 5. Setup database

Jalankan migration dan seeding data (ini akan membuat tabel dan data awal):

```bash
php artisan migrate:fresh --seed
```

> Pastikan database sudah dibuat sesuai nama di `.env`.

---

## 6. Install dan build Node.js dependencies

Kalau project menggunakan frontend (Vite/Laravel Mix), jalankan:

```bash
npm install
npm run build
```

> Pastikan Node.js dan npm sudah terinstall.
> Untuk development, bisa juga pakai: `npm run dev` supaya otomatis reload saat ubah kode frontend.

---

## 7. Link storage

Kalau project menyimpan file publik (misal upload gambar), jalankan:

```bash
php artisan storage:link
```

---

## 8. Jalankan project

Untuk menjalankan server lokal Laravel:

```bash
php artisan serve
```

Buka browser dan akses:

```
http://127.0.0.1:8000
```

