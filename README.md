# Judul Proyek: API Layanan Manajemen Tugas Pribadi

## Deskripsi Singkat
Sebuah web service (API) RESTful yang dibangun menggunakan Laravel 10 untuk mengelola data tugas pribadi. Sistem ini menyediakan fungsionalitas untuk autentikasi pengguna menggunakan JWT serta operasi CRUD (Create, Read, Update, Delete, Search) untuk data tugas.

---

## Cara Menjalankan Sistem

Berikut adalah langkah-langkah untuk menjalankan proyek ini secara lokal.

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/daftartugaslaravelapi/api-manajemen-tugas-pribadi.git
    ```

2.  **Masuk ke Direktori Proyek**
    ```bash
    cd api-manajemen-tugas-pribadi
    ```

3.  **Instalasi Dependency**
    Jalankan Composer untuk menginstal semua package yang dibutuhkan.
    ```bash
    composer install
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    # Untuk pengguna Windows
    copy .env.example .env

    # Untuk pengguna Mac/Linux
    cp .env.example .env
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan pengaturan database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`). Pastikan Anda sudah membuat database kosong dengan nama yang sesuai.

7.  **Jalankan Migrasi dan Seeder**
    Perintah ini akan membuat semua tabel dan mengisinya dengan data awal (akun uji coba).
    ```bash
    php artisan migrate --seed
    ```

8.  **Generate JWT Secret Key**
    ```bash
    php artisan jwt:secret
    ```

9.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    API sekarang berjalan di `http://127.0.0.1:8000`.

---

## Informasi Akun Uji Coba
Anda bisa menggunakan akun berikut untuk melakukan login dan pengujian pada endpoint yang terproteksi.

-   **Email**: `jihan@gmail.com`
-   **Password**: `password`

---

## Dokumentasi API
Dokumentasi lengkap untuk semua endpoint, termasuk contoh request dan response, tersedia dalam bentuk Postman Collection.

File dokumentasi dapat ditemukan di dalam folder `docs/` pada repositori ini atau diimpor langsung ke Postman menggunakan tautan di bawah ini (setelah Anda mengunggahnya).

https://daftartugas.postman.co/workspace/Daftar-Tugas's-Workspace~7190935a-dc00-42df-8c20-7262645a1cd1/request/46906091-07a12db0-82ae-4d6b-8b7d-a822e1a50b48?action=share&creator=46906091&ctx=documentation
