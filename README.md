# Judul Proyek: API Layanan Manajemen Tugas Pribadi

## Deskripsi Singkat
Sebuah web service (API) RESTful yang dibangun menggunakan **Laravel 10** untuk mengelola data tugas pribadi. Sistem ini menyediakan fungsionalitas untuk autentikasi pengguna menggunakan **JSON Web Tokens (JWT)** serta operasi **CRUDS** (Create, Read, Update, Delete, Search) untuk data tugas, lengkap dengan fitur pencarian dan pencatatan aktivitas.

---

## Anggota Kelompok
1.  **Jihan Maulita Nabila** (NIM: 2203030019)
2.  **Cahaya Bunga K** (NIM: 2203030004)
3.  **M Puad Bawazir** (NIM: 1901010241)

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
    Buka file `.env` dan sesuaikan pengaturan database berikut dengan konfigurasi lokal Anda:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_personal_task_api
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Pastikan Anda sudah membuat sebuah database kosong dengan nama yang sesuai.*

7.  **Jalankan Migrasi dan Seeder**
    Perintah ini akan membuat semua tabel dan mengisinya dengan data awal (akun uji coba).
    ```bash
    php artisan migrate --seed
    ```

8.  **Generate JWT Secret Key**
    Buat kunci rahasia untuk autentikasi JWT.
    ```bash
    php artisan jwt:secret
    ```

10.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    API sekarang berjalan di `http://127.0.0.1:8000`.

---

## Informasi Akun Uji Coba
Gunakan akun berikut untuk melakukan login dan pengujian pada endpoint yang terproteksi.

-   **Email**: `jihan@gmail.com`
-   **Password**: `password`

---

## Dokumentasi API
Dokumentasi lengkap untuk semua endpoint, termasuk parameter, contoh request, dan contoh response (baik sukses maupun gagal), tersedia dalam bentuk **Postman Collection**.

File dokumentasi dapat ditemukan di dalam folder `docs/` pada repositori ini atau diimpor langsung ke Postman menggunakan tautan di bawah ini.

https://daftartugas.postman.co/workspace/Daftar-Tugas's-Workspace~7190935a-dc00-42df-8c20-7262645a1cd1/example/46906091-161daaa0-80aa-4510-8086-eab2fc1647dd?action=share&creator=46906091&ctx=documentation
