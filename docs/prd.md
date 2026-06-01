# PRD Etalasia MVP

## 1. Ringkasan Produk
Etalasia adalah website katalog affiliate untuk produk Shopee dan TikTok. Pengunjung dapat melihat produk yang dikurasi, mencari dan memfilter produk, lalu klik tombol marketplace untuk membuka link affiliate di tab baru. Admin mengontrol seluruh isi katalog dari dashboard Filament.

Prioritas v1 adalah katalog yang cepat, ringan, mobile-first, dan mudah dikelola. Dashboard dibuat lebih dulu agar data produk, kategori, banner, dan link affiliate bisa dikontrol tanpa edit kode.

## 2. Tujuan Produk
- Menyediakan katalog affiliate yang rapi untuk produk Shopee dan TikTok.
- Memudahkan admin mengelola produk, kategori, dan banner promo.
- Membuat halaman publik yang cepat dibuka di mobile.
- Mendukung produk dengan satu atau dua tombol affiliate: Shopee dan/atau TikTok.
- Mencatat klik affiliate sederhana untuk melihat performa dasar.

## 3. Target Pengguna
- Pengunjung utama: pembeli mobile dari TikTok, Instagram, WhatsApp, atau link sosial lain.
- Admin: pemilik/pengelola Etalasia yang memasukkan produk, mengatur kategori, banner, dan melihat klik dasar.

## 4. Scope MVP
Masuk scope v1:
- Dashboard admin Filament.
- CRUD kategori satu level.
- CRUD produk affiliate.
- CRUD banner promo homepage.
- Homepage katalog publik.
- Halaman listing per kategori.
- Search dan filter lengkap.
- Redirect tracking klik affiliate.
- UI clean marketplace dengan brand style Etalasia.

Tidak masuk scope v1:
- Halaman detail produk.
- Import CSV/XLSX.
- API/scraping otomatis Shopee/TikTok.
- Role dan permission kompleks.
- Multi-vendor atau marketplace selain Shopee/TikTok.
- Checkout, cart, payment, atau stok internal.
- Affiliate disclosure.

## 5. Fitur Dashboard
Dashboard menggunakan Filament dengan admin setara tanpa role kompleks.

Resource kategori:
- Nama kategori.
- Slug otomatis/manual.
- Status aktif/nonaktif.
- Urutan tampil.
- Ikon atau gambar opsional via upload atau URL.

Resource produk:
- Nama produk.
- Slug.
- Kategori.
- Gambar produk via upload file atau URL gambar.
- Harga numerik opsional untuk filter.
- Teks harga/display price.
- Status aktif/nonaktif.
- Featured/unggulan.
- Urutan manual.
- Link affiliate Shopee opsional.
- Link affiliate TikTok opsional.
- Total klik Shopee dan TikTok.

Resource banner:
- Judul internal/banner.
- Gambar via upload file atau URL gambar.
- Link tujuan affiliate/promo.
- Status aktif/nonaktif.
- Urutan tampil.
- Total klik banner.

## 6. Fitur Katalog Publik
Homepage:
- Header brand Etalasia.
- Banner promo aktif.
- Shortcut kategori aktif.
- Produk unggulan dan listing utama.
- Search dan filter.

Halaman kategori:
- Menampilkan produk aktif dari kategori terkait.
- Mempertahankan search, filter marketplace, harga, dan sorting.

Kartu produk:
- Gambar produk lazy-loaded.
- Nama produk.
- Harga/display price.
- Badge kategori.
- Badge marketplace yang tersedia.
- Tombol Shopee jika link Shopee tersedia.
- Tombol TikTok jika link TikTok tersedia.
- Tombol membuka tab baru dengan `target="_blank"`.

Filter:
- Search berdasarkan nama produk.
- Filter kategori.
- Filter marketplace: Shopee, TikTok, atau keduanya.
- Filter rentang harga jika harga numerik tersedia.
- Sort: unggulan/manual, terbaru, termurah, dan termahal.

## 7. Perilaku Klik Affiliate
Semua klik affiliate melewati route redirect internal agar sistem bisa mencatat klik sebelum mengarahkan user ke link tujuan.

Produk:
- User klik tombol Shopee atau TikTok.
- Sistem mencatat klik pada counter marketplace terkait.
- Sistem redirect ke URL affiliate marketplace terkait di tab baru.
- Jika link tidak tersedia atau produk nonaktif, tombol tidak ditampilkan.

Banner:
- User klik banner.
- Sistem mencatat klik banner.
- Sistem redirect ke link banner.

## 8. Kebutuhan Non-Fungsional
Performa:
- Public catalog server-rendered memakai Blade.
- JavaScript minimal.
- Gambar lazy-loaded.
- Listing memakai pagination.
- Query memakai eager loading dan index database untuk field penting.

Mobile-first:
- Layout utama dioptimalkan untuk layar mobile.
- Tombol affiliate mudah disentuh.
- Kartu produk stabil dan tidak berubah ukuran secara mengganggu.
- Teks tidak boleh overflow.

SEO dasar:
- Slug kategori dan produk unik.
- Title dan meta description dasar untuk homepage dan kategori.
- Struktur HTML semantik.
- Artikel SEO tidak masuk v1.

Keamanan:
- Dashboard hanya untuk admin login.
- Link affiliate divalidasi sebagai URL di dashboard.
- Upload gambar memakai file upload image public.
- Produk/banner nonaktif tidak tampil publik.

## 9. Data Utama
Entitas utama:
- `categories`
- `products`
- `banners`

Relasi:
- Satu kategori punya banyak produk.
- Satu produk punya maksimal dua link affiliate: Shopee dan TikTok.
- Banner berdiri sendiri dan tampil di homepage berdasarkan status serta urutan.

## 10. Success Metrics
MVP dianggap berhasil jika:
- Admin bisa membuat kategori, produk, dan banner dari dashboard.
- Produk aktif tampil di homepage dan halaman kategori.
- Produk bisa punya tombol Shopee saja, TikTok saja, atau keduanya.
- Search dan filter berjalan sesuai data produk.
- Klik affiliate terbuka di tab baru dan tercatat.
- Halaman publik nyaman dipakai di mobile.
- Tidak ada error utama pada create/edit/delete data dashboard.

## 11. Acceptance Criteria
- Admin dapat login ke dashboard Filament.
- Admin dapat CRUD kategori.
- Admin dapat CRUD produk dengan gambar upload atau URL.
- Admin dapat CRUD banner dengan gambar upload atau URL.
- Produk nonaktif tidak tampil di katalog publik.
- Kategori nonaktif tidak tampil di navigasi publik.
- Banner nonaktif tidak tampil di area promo.
- Tombol Shopee hanya tampil jika produk punya link Shopee.
- Tombol TikTok hanya tampil jika produk punya link TikTok.
- Klik tombol affiliate membuka tab baru dan mencatat klik.
- Search mencari produk berdasarkan nama.
- Filter marketplace, kategori, harga, dan sort dapat dikombinasikan.
- Homepage dan halaman kategori responsif di mobile dan desktop.

## 12. Asumsi Teknis
- Project menggunakan Laravel 13, PHP 8.3, MySQL, Vite, Tailwind 4, Pest, dan Filament 5.
- Public catalog memakai Blade, bukan SPA.
- Livewire dipakai terutama oleh Filament/dashboard.
- Brand Etalasia belum punya guideline final, jadi v1 memakai identitas visual awal yang mudah diganti.
