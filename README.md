<div align="center">
  <img src="/public/images/Etalasia%20Logo%20Orange.svg" alt="Logo Etalasia" width="120" />

  <h3>Etalasia — Premium Shopee & TikTok Affiliate Catalog Platform</h3>

  <p align="center">
    <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
    <img src="https://img.shields.io/badge/Filament%20PHP-v3-EBB308?style=for-the-badge&logo=laravel&logoColor=black" alt="Filament PHP v3">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3+">
    <img src="https://img.shields.io/badge/Pest%20PHP-Tests%20Passed-01C1D6?style=for-the-badge&logo=pest&logoColor=white" alt="Pest Tests">
    <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT"></a>
  </p>

  <br/>

  **Etalasia** adalah platform katalog afiliasi (*affiliate catalog platform*) modern yang dikembangkan untuk mengkurasi produk-produk pilihan terbaik dari **Shopee** dan **TikTok**. Platform ini menghadirkan *seamless user experience* bagi pengunjung untuk mencari, menyaring, menyimpan ke *wishlist*, dan membagikan produk favorit mereka, sebelum diarahkan langsung ke tautan belanja afiliasi (*affiliate link*).

  Pada bagian *back-office*, admin dibekali dengan *dashboard* berbasis Filament PHP yang tangguh untuk mengelola inventaris produk, mengklasifikasikan kategori, mengatur *campaign banner*, memantau metrik performa (*click-through analytics*), hingga melakukan impor data secara massal (*bulk import*).

  <br/>
  
  <a href="https://github.com/marvaproject/Etalasia">
    <img src="[TODO: Path screenshot katalog utama, contoh: docs/screenshots/catalog.png]" alt="Etalasia Catalog Home Preview" width="800">
  </a>
</div>

<br/><br/>

## 🚀 Key Features (Fitur Utama)

### 1. High-Performance Catalog Frontend (Katalog Publik)
* **Single Page Application (SPA) AJAX Content Swap**: Transisi halaman, penyaringan kategori, pencarian, *reset filter*, dan navigasi *pagination* diproses secara asinkronus menggunakan AJAX. Mencegah pemuatan ulang seluruh halaman (*full page reload*) dan menjaga posisi *viewport scroll* agar layar tidak meloncat ke atas (*no page scroll/layout jumps*).
* **Persistent Wishlist & Sticky Header**: Fitur penyimpanan produk berbasis *browser LocalStorage* terintegrasi langsung di bagian kanan *sticky header*. Dilengkapi dengan *dynamic badge counter* dan perubahan status visual tombol (warna border & background berubah menjadi oranye hangat secara *real-time*) saat filter wishlist diaktifkan.
* **Smart Image Auto-Retry & Fallback Mechanism**: Pemuatan aset gambar dilakukan secara asinkronus di latar belakang (*background image loading*). Jika terjadi kegagalan muat akibat masalah jaringan, sistem otomatis menjalankan *retry mechanism* (maksimal 3 kali dengan jeda *progressive backoff* + parameter *cache-buster*). Jika gagal total, gambar dialihkan ke inline SVG placeholder untuk menghindari efek skeleton loader tersangkut (*stuck shimmer layout*).
* **Click Redirection & Analytics Tracker**: Setiap navigasi menuju *checkout link* dipetakan melalui *redirection endpoints* `/go/product/{product}/{marketplace}` dan `/go/banner/{banner}` untuk mencatat riwayat klik sebelum pengguna diteruskan ke *destination URL* Shopee/TikTok.
* **Native Web Share API & Clipboard Integration**: Tombol bagikan (*share button*) memanfaatkan interaksi bawaan sistem operasi melalui *Native Web Share API* (pada *device* pendukung) dengan fallback menyalin tautan secara instan ke *clipboard* yang disertai notifikasi *toast alert* melayang.
* **Auto-Play Hero Banner Carousel**: Slider promosi horizontal di halaman depan yang bergeser secara otomatis (*autoplay*), mendukung interaksi sentuh (*touch swipe/mouse drag gestures*), dan dilengkapi navigasi dot indikator yang responsif.

### 2. Back-Office Admin Panel & Dashboard (Filament)
* **Responsive Grid Analytics Widget**: Halaman *dashboard* ringkas yang memaparkan 5 kartu metrik utama (Produk Aktif, Kategori Aktif, Klik Banner, Klik Shopee, Klik TikTok) dalam tata letak grid responsif 2 baris (3 kolom pada baris pertama dan 2 kolom pada baris kedua) pada desktop.
* **Instant AJAX Toggle Switcher**: Kolom status aktif (`is_active`) pada tabel Produk, Kategori, dan Banner menggunakan komponen *Toggle Column*. Admin dapat mengaktifkan atau menonaktifkan data secara instan melalui AJAX langsung dari baris tabel tanpa harus memuat form edit.
* **Mass CSV & JSON Product Importer**: Fungsionalitas impor massal data produk yang terintegrasi dengan template dokumen bawaan (CSV & JSON). Dilengkapi dengan:
  * Pembersih *BOM UTF-8* dan *automatic delimiter detector* (koma atau titik koma).
  * *Dynamic category creator* berbasis *fuzzy matching* yang otomatis memetakan nama kategori ke ikon Tabler yang relevan (misalnya mendeteksi kata "baju" untuk dipetakan ke ikon pakaian).
  * *Smart price range parser* untuk mengubah representasi rentang teks harga menjadi nominal digit numerik terendah secara otomatis.
  * *Skip-validation logic* untuk menyaring baris data cacat (seperti produk yang tidak memiliki tautan Shopee maupun TikTok).
* **Optimized Redirect Policy**: Setelah admin melakukan *submit* (menyimpan perubahan atau membuat produk baru), alur pengisian form langsung diarahkan kembali (*redirect*) ke tabel inventaris utama untuk efisiensi alur kerja (kecuali saat menggunakan tombol "Create & Create Another").
* **Advanced Table Filtering**: Filter khusus berdasarkan kategori dan platform *marketplace* aktif yang mengevaluasi keberadaan *affiliate link* Shopee dan TikTok secara dinamis.

<br/><br/>

## 🛠️ Technical Stack & Ecosystem

Platform ini dibangun menggunakan ekosistem teknologi modern dengan performa tinggi:

* **Core Framework**: [Laravel 11 / 12 / 13](https://laravel.com) (PHP >= 8.3)
* **Back-Office Engine**: [Filament PHP v3](https://filamentphp.com) (TALL Stack-ready)
* **Database Management System**: MySQL
* **Frontend Assets**: Tailwind CSS, Vanilla CSS (Custom UI Tokens), Vanilla JavaScript (Core SPA Engine)
* **Primary Dependencies**:
  * `secondnetwork/blade-tabler-icons` (Koleksi ikon Tabler resmi terintegrasi Blade)
  * `guava/filament-icon-picker` (Komponen visual pemilih ikon kategori di admin panel)
  * `pestphp/pest` (Testing framework modern untuk backend PHP)

<br/><br/>

## 💻 Local Development Setup Guide (Panduan Instalasi)

Ikuti langkah-langkah di bawah ini untuk melakukan instalasi dan menjalankan proyek Etalasia di lingkungan pengembangan lokal Anda (misalnya menggunakan XAMPP atau Laragon):

### Step 1: Clone the Repository
Buka terminal atau command prompt Anda, jalankan perintah git berikut untuk menyalin kode sumber:
```bash
git clone https://github.com/marvaproject/Etalasia.git
cd etalasia
```

### Step 2: Install PHP & JavaScript Dependencies
Unduh dan pasang paket pustaka pihak ketiga melalui Composer dan NPM:
```bash
# Install PHP vendor packages
composer install

# Install JavaScript package dependencies
npm install
```

### Step 3: Create Local Database in phpMyAdmin
1. Aktifkan modul **Apache** dan **MySQL** pada panel kontrol server lokal Anda (XAMPP / Laragon).
2. Akses halaman administrasi database melalui web browser di: `http://localhost/phpmyadmin`.
3. Pilih opsi **New** (Baru) pada bilah menu sebelah kiri.
4. Masukkan nama database: `etalasia`.
5. Klik tombol **Create** (Buat).

### Step 4: Database Import via phpMyAdmin (Schema & Seeders)
Untuk memuat seluruh struktur tabel database beserta data contoh produk awal, impor file SQL yang disediakan:
1. Pastikan Anda sedang memilih database `etalasia` di panel kiri phpMyAdmin.
2. Klik tab **Import** pada baris menu bagian atas.
3. Pada bagian **File to import**, klik **Choose File** (Pilih File).
4. Pilih file SQL skema database:
   * **[TODO: Tentukan lokasi file schema SQL, contoh: database/sql/database.sql]**
5. Gulir ke bagian paling bawah, lalu klik tombol **Import** (Kirim).
6. Ulangi langkah di atas (1-5) untuk mengimpor file data contoh bawaan:
   * **[TODO: Tentukan lokasi file data SQL sampel, contoh: database/sql/data.sql]**

### Step 5: Environment Variables Configuration (`.env`)
1. Salin file template konfigurasi `.env.example` menjadi file `.env` aktif:
   ```bash
   cp .env.example .env
   ```
2. Buka file `.env` menggunakan teks editor Anda, cari bagian konfigurasi koneksi database, dan sesuaikan dengan kredensial server lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=etalasia
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Step 6: Generate App Encryption Key
Jalankan perintah pengamanan enkripsi Laravel untuk mengisi nilai `APP_KEY` pada file `.env`:
```bash
php artisan key:generate
```

### Step 7: Create Storage Symlink
Hubungkan direktori penyimpanan lokal agar file media yang diunggah dapat diakses secara publik melalui URL web:
```bash
php artisan storage:link
```

> [!NOTE]
> Jika Anda tidak ingin mengimpor database secara manual lewat phpMyAdmin dan ingin memulai dari database kosong baru, Anda dapat menjalankan perintah standard migration & seeder:
> ```bash
> php artisan migrate --seed
> ```

### Step 8: Asset Bundling & Compiling
Lakukan kompilasi aset frontend menggunakan bundler Vite:
```bash
npm run build
```

### Step 9: Spin Up Development Servers
Jalankan lokal server Laravel di terminal utama Anda:
```bash
php artisan serve
```
Kemudian jalankan server pengembangan Vite di terminal atau tab terpisah:
```bash
npm run dev
```

Platform katalog utama kini siap diakses pada web browser Anda melalui alamat: `http://127.0.0.1:8000`.

<br/><br/>

## 🔐 Admin Portal Credentials (Kredensial Login Admin)

Untuk mengakses dashboard admin guna mengelola data produk, kategori, banner, atau memproses file impor massal, gunakan informasi login berikut:

> [!IMPORTANT]
> **Kredensial Default Admin Panel**:
> * **Portal URL**: `http://127.0.0.1:8000/admin`
> * **Username/Email**: `Tanya atmin`
> * **Password**: `Tanya atmin`

<br/><br/>

## 📸 Screenshots & User Interface Reference

Sertakan tangkapan layar tampilan antarmuka aplikasi di bawah ini sebagai referensi visual:

| Interface / Component | Description | Screenshot Preview (TODO to Replace) |
| :--- | :--- | :--- |
| **Catalog Frontend (Home)** | Halaman utama katalog publik, pencarian produk, slider banner, dan grid daftar produk. | ![Catalog Home]([TODO: Path screenshot katalog utama, contoh: docs/screenshots/catalog.png]) |
| **Sticky Header & Wishlist** | Komponen wishlist sticky header, filter kategori aktif, dan status badge penyaring produk favorit. | ![Wishlist Header]([TODO: Path screenshot wishlist header, contoh: docs/screenshots/wishlist.png]) |
| **Admin Stats Overview** | Tampilan panel statistik 5 kolom (Produk, Kategori, Banner, Shopee, TikTok) pada Dashboard Filament. | ![Stats Overview]([TODO: Path screenshot dashboard stats, contoh: docs/screenshots/dashboard.png]) |
| **Product Inventory Table** | Tabel kelola produk, tombol edit baris samping nama, switcher aktif, dan modal bulk import CSV/JSON. | ![Product Importer]([TODO: Path screenshot list produk & modal impor, contoh: docs/screenshots/impor.png]) |
