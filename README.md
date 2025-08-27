<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### **Perancangan dan Pengembangan Website Buku Tamu Digital**

Ini adalah proyek magang untuk merancang dan mengembangkan **website buku tamu digital** untuk Balai Besar Penjaminan Mutu Pendidikan (BBPMP) Jawa Tengah. Aplikasi ini dibuat untuk menggantikan buku tamu berbasis kertas yang tidak efisien dalam mencatat data tamu dan berisiko kehilangan informasi.

Sistem ini dirancang untuk mencatat data tamu secara otomatis, cepat, dan terstruktur, serta mempermudah akses informasi bagi pihak yang membutuhkan.

-----

### **Fitur Utama Proyek**

Proyek ini memiliki beberapa fitur inti untuk memudahkan pengelolaan tamu secara digital:

  * **Form Buku Tamu:** Memungkinkan tamu untuk mengisi data secara digital, termasuk nama, alamat, nomor telepon, instansi, keperluan, dan pengambilan foto otomatis.
  * **Login Admin:** Sistem hanya dapat diakses oleh satu akun admin atau resepsionis untuk mengelola data.
  * **Dashboard Admin:** Admin dapat melihat statistik kunjungan tamu berdasarkan jenis kelamin atau filter tanggal.
  * **Laporan:** Admin dapat melihat, mengedit, dan menghapus data tamu, serta mengunduh laporan dalam format **PDF** atau **Excel**.

-----

### **Teknologi yang Digunakan**

Proyek ini dikembangkan menggunakan tumpukan teknologi modern untuk memastikan efisiensi dan fungsionalitas:

  * **Backend:** Framework **Laravel 10** digunakan untuk mengelola logika bisnis, *routing*, dan autentikasi.
  * **Frontend:** Aplikasi ini menggunakan **HTML** untuk struktur, **CSS** dan **Bootstrap** untuk desain visual responsif, serta **JavaScript** untuk interaktivitas dinamis dan fitur pengambilan foto otomatis.
  * **Database:** **MySQL** digunakan sebagai basis data untuk menyimpan informasi tamu, admin, dan log aktivitas.
  * **Laporan:** Proyek ini mengintegrasikan pustaka **Laravel Excel** untuk mendukung fitur ekspor laporan.

-----

### **Metodologi Pengembangan dan Diagram Sistem**

Proyek ini dikembangkan menggunakan metodologi **Waterfall** yang terstruktur. Tahapannya mencakup analisis kebutuhan, perancangan, implementasi, pengujian, dan pemeliharaan.

Berikut adalah diagram yang menggambarkan arsitektur sistem:

#### **Use Case Diagram**

Diagram ini menggambarkan interaksi antara pengguna (tamu dan admin) dengan sistem.

  * **Admin:** Dapat melakukan login, mengelola data (edit, hapus), melihat statistik, dan mengunduh laporan.
  * **Tamu:** Mengisi formulir buku tamu melalui akun resepsionis.

#### **Activity Diagram**

Diagram ini menunjukkan alur aktivitas dari pengisian buku tamu, mulai dari mengakses tombol "Isi Buku Tamu" hingga data disimpan ke database.

#### **Sequence Diagram**

Diagram ini menjelaskan urutan interaksi antara admin, sistem, dan database untuk proses *login*, pengisian formulir, dan akses *dashboard*.

#### **Entity Relationship Diagram (ERD)**

ERD menunjukkan struktur database dengan tabel-tabel utama:

  * **`Users`:** Menyimpan data admin/resepsionis.
  * **`GuestsBook`:** Menyimpan data tamu.
  * **`Logs`:** Mencatat aktivitas yang dilakukan oleh admin.

-----

### **Langkah-langkah Instalasi (Perkiraan)**

Meskipun tidak dijelaskan secara eksplisit, proyek berbasis Laravel umumnya memerlukan langkah-langkah berikut untuk dijalankan:

1.  **Clone Repositori:**
    ```bash
    git clone https://github.com/arsyadfai/bukutamu-app.git
    cd bukutamu-app
    ```
2.  **Instal Dependensi:** Pastikan Composer sudah terinstal, lalu jalankan:
    ```bash
    composer install
    ```
3.  **Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Konfigurasi Database:** Buka file `.env` dan sesuaikan pengaturan database `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan konfigurasi MySQL lokal Anda.
5.  **Jalankan Migrasi:** Buat tabel-tabel database dengan menjalankan perintah migrasi:
    ```bash
    php artisan migrate
    ```
6.  **Jalankan Server:** Jalankan aplikasi menggunakan server bawaan Laravel:
    ```bash
    php artisan serve
    ```
    Aplikasi akan tersedia di `http://localhost:8000`.

-----

### **Kelebihan dan Kekurangan Proyek**

Berdasarkan laporan, proyek ini memiliki:

  * **Kelebihan:** Efisiensi dalam menyimpan dan menampilkan data secara *real-time*, keamanan sistem melalui login admin, antarmuka yang ramah pengguna (*user-friendly*), dan integrasi statistik yang mempermudah admin. Penggunaan Laravel juga membuat struktur kode rapi dan mudah diintegrasikan dengan pustaka lain.
  * **Kekurangan:** Sistem ini hanya mendukung satu akun admin dan belum mendukung multi-bahasa.

-----

### **Saran Pengembangan Lanjutan**

Laporan ini menyarankan beberapa perbaikan untuk masa depan, termasuk:

  * **Dukungan Multi-Akun:** Menambahkan fitur untuk beberapa akun admin agar kolaborasi lebih baik.
  * **Peningkatan UI/UX:** Menyempurnakan desain antarmuka agar lebih menarik bagi pengguna non-teknis.
  * **Fitur Notifikasi:** Mengintegrasikan notifikasi *email* atau SMS untuk konfirmasi tamu.
  * **Multi-Bahasa:** Menambahkan dukungan multi-bahasa.
  * **Integrasi API:** Mengembangkan API untuk terhubung dengan sistem eksternal.
