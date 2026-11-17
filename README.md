# Aplikasi Service Motor

Aplikasi berbasis Laravel + MySQL untuk mengelola pelanggan, kendaraan,
daftar service, data service, dan pembayaran. Dilengkapi REST API yang
diuji dengan Postman.

## Kebutuhan

- PHP 8.2+
- Composer
- MySQL (XAMPP)
- Git

## Cara Instalasi

1. Clone repository dan install dependensi:

        git clone https://github.com/fcriiakbar/service-motor.git
        cd service-motor
        composer install
        cp .env.example .env
        php artisan key:generate

2. Buat database kosong `db_service_motor` di phpMyAdmin, lalu sesuaikan
   pengaturan database di file `.env` bila perlu.

3. Jalankan migrasi dan server:

        php artisan migrate
        php artisan serve

4. Buka aplikasi:

   - Web: http://127.0.0.1:8000
   - API: http://127.0.0.1:8000/api

## Endpoint API

- /api/pelanggan
- /api/kendaraan
- /api/daftar-service
- /api/data-service
- /api/pembayaran

Setiap endpoint mendukung GET (semua), POST, GET (detail), PUT, dan DELETE.

## Postman

Import file `docs/Service Motor API.postman_collection.json`.