# Rekomendasi Desain Ulang Layout Etalasia

> Tujuan: Tampilan langsung seperti marketplace (Shopee/TikTok Shop) — produk dan promo langsung terlihat, tanpa hero section dan CTA.

---

## Masalah Layout Sekarang

```
[Header]
[Hero section besar — tagline + h1 + CTA]  ← TIDAK DIPERLUKAN
[Banner (hanya tampil di hero)]
[Category tabs]
[Filter form]
[Grid produk] ← user baru lihat ini setelah scroll
```

User harus scroll cukup jauh sebelum melihat produk. Di mobile, hero section memakan seluruh layar pertama.

---

## Layout Baru yang Direkomendasikan

```
[Header compact — logo + search bar]
[Banner promo — full width, aspect 2:1]
[Category shortcuts — ikon/pil horizontal scroll]
[Filter bar tipis — collapsed/expandable]
[Grid produk — langsung terlihat tanpa scroll]
[Pagination]
[Footer minimal]
```

### Prinsip yang digunakan (dari skill `ui-ux-pro-max`):
- **`content-priority`**: Tampilkan konten utama (produk) secepat mungkin di mobile
- **`mobile-first`**: Layout dirancang untuk 375px terlebih dahulu
- **`touch-target-size`**: Semua tombol ≥ 44px
- **`lazy-load-below-fold`**: Gambar produk tetap lazy-loaded
- **`no-horizontal-scroll`**: Hanya category shortcuts yang horizontal scroll (dengan overscroll-behavior: contain)

---

## Perubahan Spesifik

### 1. Header — Compact + Search Bar Inline

**Sekarang:** Logo kiri, tombol "Lihat Produk" kanan  
**Rekomendasi:** Logo kiri, **search bar di tengah/kanan** (seperti Shopee mobile header)

```
┌─────────────────────────────────────┐
│ [E] Etalasia  [🔍 Cari produk...]   │
└─────────────────────────────────────┘
```

- Header lebih compact: `py-2` bukan `py-4`
- Search bar langsung di header → user tidak perlu scroll ke filter
- Input `type="search"` dengan `inputmode="search"` untuk keyboard yang tepat di mobile

---

### 2. Banner — Full Width, Langsung di Bawah Header

**Sekarang:** Banner ada di dalam hero section (50% lebar layar di desktop)  
**Rekomendasi:** Banner **full width**, aspect ratio `2:1` di mobile, langsung setelah header

```
┌─────────────────────────────────────┐
│                                     │
│        [BANNER PROMO]               │
│        aspect 2:1 full width        │
│                                     │
└─────────────────────────────────────┘
```

- Jika ada 2 banner: tampilkan sebagai **slider sederhana** (auto-scroll CSS) atau keduanya bertumpuk vertikal
- Loading: banner pertama `loading="eager"`, sisanya `loading="lazy"`

---

### 3. Category Shortcuts — Ikon Grid Horizontal

**Sekarang:** Text pills di bar tipis  
**Rekomendasi:** Grid ikon/gambar dengan label, seperti shortcut kategori Shopee

```
┌──────────────────────────────────────────────┐
│  [Semua] [Skincare] [Fashion] [Elektronik] →  │
│  (scroll horizontal, pills dengan ikon)        │
└──────────────────────────────────────────────┘
```

- Gunakan `overflow-x: auto; scrollbar-width: none` (sudah ada di kode sekarang ✅)
- Tambahkan `overscroll-behavior-x: contain` untuk mencegah page refresh saat swipe
- Padding `scroll-px-4` agar item pertama tidak terpotong

---

### 4. Filter — Collapsed by Default di Mobile

**Sekarang:** Filter form selalu terbuka (memakan banyak ruang)  
**Rekomendasi:** Filter tampil sebagai **bar ringkas** dengan tombol expand

```
Mobile (collapsed):
┌──────────────────────────────────────────┐
│  Sort: Unggulan ▼   Marketplace: Semua ▼  [Filter ⚙] │
└──────────────────────────────────────────┘

Mobile (expanded, via JS toggle):
┌──────────────────────────────────────────┐
│  [Form filter lengkap muncul]            │
└──────────────────────────────────────────┘
```

- Desktop: filter tetap terbuka full (seperti sekarang)
- Mobile: hanya tampilkan Sort + Marketplace dropdown, sisanya di tombol "Filter"
- Indikator badge jika ada filter aktif (sudah ada logikanya di kode ✅)

---

### 5. Grid Produk — Lebih Compact, Marketplace Feel

**Sekarang:** `rounded-[20px]`, padding `p-4 sm:p-5`, shadow medium  
**Rekomendasi:**

- **Mobile**: 2 kolom, kartu lebih compact (`p-2` atau `p-3`), nama produk 1-2 baris, harga bold
- **Desktop**: 4 kolom (sama seperti sekarang)
- Rasio gambar: `aspect-[3/4]` (portrait, lebih natural untuk produk fashion/beauty) alih-alih `aspect-square`
- Nama produk: font lebih kecil di mobile (`text-xs`), harga lebih dominan

#### Tombol Affiliate — Auto-Layout (Shopee & TikTok)

Etalasia hanya mendukung **2 marketplace: Shopee dan TikTok**. Setiap produk bisa punya:
- Hanya link Shopee → tombol Shopee **full width**
- Hanya link TikTok → tombol TikTok **full width**
- Keduanya → tombol **side-by-side** 50:50

```
Produk dengan 1 link:          Produk dengan 2 link:
┌──────────────────┐           ┌─────────┐ ┌─────────┐
│                  │           │         │ │         │
│  [  Shopee  ]    │           │ Shopee  │ │  TikTok │
│                  │           │         │ │         │
└──────────────────┘           └─────────┘ └─────────┘
      full width                  50%  :  50%
```

**Implementasi yang benar** (hindari dynamic Tailwind class string):
```blade
{{-- Auto-layout: grid-cols-1 jika 1 link, grid-cols-2 jika keduanya --}}
@if ($product->shopee_url && $product->tiktok_url)
    <div class="grid grid-cols-2 gap-2">
@else
    <div class="grid grid-cols-1">
@endif
    @if ($product->shopee_url)
        <a href="...">Shopee</a>
    @endif
    @if ($product->tiktok_url)
        <a href="...">TikTok</a>
    @endif
</div>
```

> ⚠️ **Catatan penting:** Jangan gunakan `grid-cols-{{ $var }}` — Tailwind tidak bisa men-scan class dinamis. Gunakan `@if`/`@else` seperti di atas.

---

### 6. Hapus Sepenuhnya

| Elemen | Alasan |
|--------|--------|
| Hero section (h1 + tagline + paragraf) | Tidak relevan di marketplace-style, memakan viewport |
| Tombol "Lihat Produk" di header | Tidak perlu, produk langsung terlihat |
| Teks "Shopee & TikTok picks" badge | Redundant |

---

## Referensi Visual — Benchmark

| Aplikasi | Elemen yang diadopsi |
|----------|---------------------|
| **Shopee** | Header compact + search, banner full-width, category shortcuts horizontal, grid 2-kolom |
| **TikTok Shop** | Kartu produk portrait, harga prominent, tombol beli langsung full-width |

---

## Ringkasan Perubahan File

| File | Perubahan |
|------|-----------|
| `layouts/app.blade.php` | Header compact + search bar inline |
| `catalog/index.blade.php` | Hapus hero section, pindahkan banner ke atas, filter collapsed di mobile, grid compact |
| `resources/css/app.css` | Tambahkan `overscroll-behavior: contain` untuk category scroll |

---

## Apakah mau langsung diimplementasikan?

Saya bisa langsung implementasi semua perubahan di atas. Atau jika ada bagian tertentu yang ingin diprioritaskan lebih dulu (misalnya hanya hapus hero + pindahkan banner), bisa dikerjakan bertahap.
