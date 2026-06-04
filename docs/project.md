# Dokumentasi Proyek Etalasia

> Dokumen ini menjelaskan arsitektur, fitur, alur kerja, dan struktur kode dari proyek **Etalasia** — website katalog affiliate Shopee & TikTok.

---

## 1. Gambaran Umum

**Etalasia** adalah website katalog affiliate yang memungkinkan admin mengumpulkan dan menampilkan produk-produk pilihan dari **Shopee** dan **TikTok Shop** dalam satu tempat. Pengunjung dapat mencari, memfilter, dan langsung klik tombol untuk membuka link affiliate di tab baru.

Proyek ini dibangun sebagai **Final Project mata kuliah Programming for Business** di Universitas BINUS, Semester 4.

### Tujuan Utama
- Menyediakan katalog affiliate yang rapi, cepat dibuka di mobile
- Memudahkan admin mengelola produk, kategori, dan banner tanpa edit kode
- Mencatat setiap klik affiliate untuk melihat performa dasar

---

## 2. Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 13, PHP 8.3 |
| **Database** | MySQL |
| **Admin Dashboard** | Filament v5.6 |
| **Realtime UI (Admin)** | Livewire v3 |
| **Frontend (Public)** | Blade + Tailwind CSS v4 |
| **Build Tool** | Vite |
| **Testing** | Pest PHP |

---

## 3. Arsitektur Proyek

Proyek menggunakan arsitektur **MVC (Model-View-Controller)** standar Laravel dengan dua area terpisah:

```
┌─────────────────────────────────────────────────────────┐
│                    ETALASIA PROJECT                     │
├────────────────────────┬────────────────────────────────┤
│   PUBLIC CATALOG       │     ADMIN DASHBOARD             │
│   /  dan /kategori/... │     /admin                      │
│                        │                                 │
│   Blade + Tailwind     │     Filament v5 (Livewire)      │
│   Server-rendered      │     Login-protected             │
│   Mobile-first         │     CRUD full                   │
└────────────────────────┴────────────────────────────────┘
```

---

## 4. Struktur Database

Ada **3 tabel utama** yang dibuat via migration:

### `categories`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint | Primary key |
| `name` | string | Nama kategori |
| `slug` | string (unique) | URL-friendly name |
| `image_path` | string, nullable | Path gambar upload |
| `image_url` | string, nullable | URL gambar eksternal |
| `is_active` | boolean | Status tampil publik |
| `sort_order` | integer | Urutan tampil |

### `products`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint | Primary key |
| `category_id` | FK → categories | Relasi ke kategori |
| `name` | string | Nama produk |
| `slug` | string (unique) | URL-friendly name |
| `image_path` | string, nullable | Path gambar upload |
| `image_url` | string, nullable | URL gambar eksternal |
| `display_price` | string, nullable | Teks harga tampilan (contoh: "Rp79.000") |
| `price` | decimal, nullable | Harga numerik untuk filter |
| `is_active` | boolean | Status tampil publik |
| `is_featured` | boolean | Badge "Unggulan" di katalog |
| `sort_order` | integer | Urutan tampil |
| `shopee_url` | text, nullable | Link affiliate Shopee |
| `tiktok_url` | text, nullable | Link affiliate TikTok |
| `shopee_clicks` | bigint | Counter klik tombol Shopee |
| `tiktok_clicks` | bigint | Counter klik tombol TikTok |

### `banners`
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint | Primary key |
| `title` | string | Judul internal banner |
| `image_path` | string, nullable | Path gambar upload |
| `image_url` | string, nullable | URL gambar eksternal |
| `target_url` | text | Link tujuan saat diklik |
| `is_active` | boolean | Status tampil di homepage |
| `sort_order` | integer | Urutan tampil |
| `clicks` | bigint | Counter klik banner |

---

## 5. Model & Relasi

```
Category ─────────────── Product
 (HasMany)              (BelongsTo)

  - has many Products    - belongs to Category
  - scope: active()      - scope: active()
  - getImageSrcAttribute - getImageSrcAttribute
                         - affiliateUrl(marketplace)

Banner (berdiri sendiri)
  - scope: active()
  - getImageSrcAttribute
```

Semua model menggunakan:
- **`#[Fillable]`** attribute (Laravel 13 style) untuk mass assignment
- **`#[Scope]`** attribute untuk query scope `active()`
- **`getImageSrcAttribute()`** accessor yang mengembalikan URL gambar (dari storage upload atau URL eksternal, fallback ke SVG placeholder)

---

## 6. Routes

```
GET  /                              → CatalogController@home
GET  /kategori/{category:slug}      → CatalogController@category

GET  /go/product/{product}/{mp}     → AffiliateRedirectController@product
GET  /go/banner/{banner}            → AffiliateRedirectController@banner

GET  /admin                         → Filament Dashboard (login-protected)
GET  /admin/products                → Filament ProductResource
GET  /admin/categories              → Filament CategoryResource
GET  /admin/banners                 → Filament BannerResource
```

---

## 7. Fitur Katalog Publik

### Homepage (`/`)
- **Hero section** dengan tagline dan banner promo (max 2 banner)
- **Category tabs** — scroll horizontal, semua kategori aktif
- **Filter form**: search by nama, filter kategori, filter marketplace, harga min/max, sort
- **Product grid**: 2 kolom di mobile, 4 kolom di desktop
- **Indikator filter aktif**: menampilkan jumlah filter yang sedang aktif

### Halaman Kategori (`/kategori/{slug}`)
- Menggunakan view yang sama dengan homepage (satu view reusable)
- Filter kategori disembunyikan (sudah terkunci ke kategori tersebut)
- Semua filter lainnya tetap berfungsi

### Kartu Produk
Setiap kartu menampilkan:
- Gambar produk (lazy-loaded)
- Badge kategori (overlay kanan atas)
- Badge "Unggulan" (overlay kiri atas, jika `is_featured = true`)
- Nama produk
- Harga tampilan
- Badge marketplace kecil (Shopee / TikTok)
- Tombol Shopee (orange) dan/atau tombol TikTok (hitam) — hanya tampil jika link tersedia

### Filter & Sort
| Filter | Opsi |
|--------|------|
| Search | Nama produk (LIKE query) |
| Kategori | Semua / pilih satu |
| Marketplace | Semua / Shopee / TikTok / Shopee+TikTok |
| Harga Min | Numerik |
| Harga Max | Numerik |
| Sort | Unggulan (default) / Terbaru / Termurah / Termahal |

---

## 8. Alur Klik Affiliate (Redirect Tracking)

```
User klik tombol "Shopee" pada produk
       ↓
GET /go/product/{id}/shopee
       ↓
AffiliateRedirectController@product
  1. Validasi produk & kategori aktif (abort 404 jika tidak)
  2. Ambil URL affiliate dari field shopee_url
  3. Increment products.shopee_clicks += 1
  4. redirect()->away($url)  ← buka tab baru ke Shopee
```

```
User klik banner
       ↓
GET /go/banner/{id}
       ↓
AffiliateRedirectController@banner
  1. Validasi banner aktif (abort 404 jika tidak)
  2. Increment banners.clicks += 1
  3. redirect()->away($target_url)
```

Semua link affiliate menggunakan `target="_blank" rel="noopener noreferrer"`.

---

## 9. Admin Dashboard (Filament)

Dashboard diakses di `/admin` dan hanya bisa diakses oleh user yang memiliki akses (via `canAccessPanel()` di `User` model).

### Warna Brand
Dashboard menggunakan warna hijau Etalasia `#1f8a70` sebagai primary color.

### Resource yang Tersedia

#### Category Resource
- List dengan kolom: Nama, Slug, Aktif, Urutan
- Form: Nama (auto-slug), Upload gambar / URL gambar, Aktif, Urutan

#### Product Resource
- List dengan kolom: Nama, Kategori, Harga, Aktif, Unggulan, **Klik Shopee**, **Klik TikTok**, Urutan
- Form: Nama, Slug, Kategori, Teks harga, Harga numerik, Urutan, Upload/URL gambar, Link Shopee, Link TikTok, Aktif, Unggulan

#### Banner Resource
- List dengan kolom: Judul, Link, **Klik**, Urutan, Aktif
- Form: Judul, Link tujuan, Upload/URL gambar, Urutan, Aktif

### Stats Widget (Dashboard Overview)
Di halaman utama dashboard terdapat 6 stat card:
1. **Produk Aktif** — total produk aktif + jumlah unggulan
2. **Kategori Aktif** — total kategori aktif
3. **Klik Shopee** — total semua klik Shopee dari semua produk
4. **Klik TikTok** — total semua klik TikTok dari semua produk
5. **Klik Banner** — total semua klik banner + jumlah banner aktif
6. **Total Klik Affiliate** — gabungan Shopee + TikTok

---

## 10. Struktur File Penting

```
etalasia/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── CategoryResource.php       ← CRUD admin kategori
│   │   │   ├── ProductResource.php        ← CRUD admin produk
│   │   │   └── BannerResource.php         ← CRUD admin banner
│   │   └── Widgets/
│   │       └── StatsOverviewWidget.php    ← Stats card dashboard
│   ├── Http/Controllers/
│   │   ├── CatalogController.php          ← Logika halaman publik
│   │   └── AffiliateRedirectController.php ← Tracking & redirect klik
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Product.php
│   │   └── Banner.php
│   └── Providers/Filament/
│       └── AdminPanelProvider.php         ← Konfigurasi dashboard
│
├── database/
│   └── migrations/
│       └── 2026_05_24_000001_create_catalog_tables.php
│
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php                  ← Layout master publik
│   ├── catalog/
│   │   └── index.blade.php               ← Halaman katalog (home & kategori)
│   └── errors/
│       └── 404.blade.php                 ← Halaman 404 custom
│
├── routes/
│   └── web.php                           ← Route publik & affiliate
│
├── tests/Feature/
│   └── CatalogPublicTest.php             ← Test halaman publik
│
└── docs/
    ├── prd.md                            ← Product Requirements Document
    ├── progress.md                       ← Log progres implementasi
    └── project.md                        ← Dokumen ini
```

---

## 11. Cara Menjalankan Lokal

### Prasyarat
- PHP 8.3+
- MySQL
- Node.js & npm
- Composer

### Langkah

```bash
# 1. Install dependencies
composer install
npm install

# 2. Salin konfigurasi environment
cp .env.example .env

# 3. Generate app key
php artisan key:generate

# 4. Buat database MySQL bernama 'etalasia', lalu jalankan migration
php artisan migrate

# 5. Isi data demo
php artisan db:seed

# 6. Buat symlink storage untuk gambar upload
php artisan storage:link

# 7. Build frontend
npm run build

# 8. Jalankan server
php artisan serve
```

### Akses
| URL | Keterangan |
|-----|------------|
| `http://127.0.0.1:8000` | Katalog publik |
| `http://127.0.0.1:8000/admin` | Dashboard admin |

**Login admin demo:**
- Email: `admin@etalasia.test`
- Password: `password`

---

## 12. Testing

```bash
php artisan test
```

Test yang tersedia di `tests/Feature/CatalogPublicTest.php`:
- Homepage dapat diakses (HTTP 200)
- Halaman kategori aktif dapat diakses
- Kategori nonaktif mengembalikan 404
- Filter dan search bekerja
- Redirect tracking affiliate berfungsi (5 tests, 19 assertions)

---

## 13. Non-Functional Notes

- **Performa**: Public catalog server-rendered (Blade), tidak ada SPA. Gambar lazy-loaded. Pagination 12 produk per halaman.
- **Mobile-first**: Layout dioptimalkan untuk layar kecil, tombol affiliate minimal 44px tinggi (touch-friendly).
- **SEO Dasar**: Meta title dan description dinamis, canonical URL, Open Graph tags, Twitter Card. Halaman 404 custom dengan `noindex`.
- **Keamanan**: Dashboard dilindungi autentikasi Filament. Link affiliate divalidasi sebagai URL. Produk/banner nonaktif tidak tampil di publik.
- **Tailwind Dynamic Class**: Hindari interpolasi string pada Tailwind class (contoh: `grid-cols-{{ $n }}`). Gunakan conditional `@if` sebagai gantinya agar class ter-scan oleh Tailwind build.
