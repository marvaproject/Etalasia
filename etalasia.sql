-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 09 Jun 2026 pada 11.34
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etalasia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `target_url` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `clicks` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_path`, `image_url`, `target_url`, `is_active`, `sort_order`, `clicks`, `created_at`, `updated_at`) VALUES
(2, 'Gajian Sale', 'banners/01KTDSDNQEFQVM6RP99R1TDGAX.png', NULL, 'https://shopee.co.id/', 1, 2, 0, '2026-06-05 23:20:14', '2026-06-05 23:20:14'),
(3, 'Tiktok 6.6', 'banners/01KTNS0F5E4JXANGY6HYGC31PW.png', NULL, 'https://vt.tokopedia.com/t/ZS92KCfhfnhBD-iyu5L/', 1, 3, 0, '2026-06-09 01:46:57', '2026-06-09 01:46:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('etalasia-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:2;', 1780995153),
('etalasia-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1780995153;', 1780995153),
('etalasia-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1780994607),
('etalasia-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1780994607;', 1780994607);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `image_path`, `image_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(4, 'Gadget', 'film-apa-ya', 'heroicon-o-device-phone-mobile', NULL, NULL, 1, 1, '2026-06-04 11:57:14', '2026-06-04 12:42:02'),
(5, 'Perabotan', 'perabotan', 'tabler-sofa', NULL, NULL, 1, 2, '2026-06-04 12:40:22', '2026-06-04 12:40:22'),
(6, 'Kendaraan', 'kendaraan', 'tabler-motorbike', NULL, NULL, 1, 3, '2026-06-04 12:41:27', '2026-06-04 12:41:27'),
(7, 'Beauty', 'beauty', 'heroicon-o-sparkles', NULL, NULL, 1, 4, '2026-06-04 21:46:47', '2026-06-04 21:46:47'),
(8, 'Pakaian', 'pakaian', 'tabler-shirt', NULL, NULL, 1, 5, '2026-06-05 07:32:55', '2026-06-05 07:32:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_24_000001_create_catalog_tables', 1),
(5, '2026_06_02_183711_add_product_code_to_products_table', 2),
(6, '2026_06_04_083316_add_icon_to_categories_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` int(10) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `display_price` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `shopee_url` text DEFAULT NULL,
  `tiktok_url` text DEFAULT NULL,
  `shopee_clicks` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tiktok_clicks` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_code`, `category_id`, `name`, `slug`, `image_path`, `image_url`, `display_price`, `price`, `is_active`, `is_featured`, `sort_order`, `shopee_url`, `tiktok_url`, `shopee_clicks`, `tiktok_clicks`, `created_at`, `updated_at`) VALUES
(6, 1, 8, 'Lazy Pajamas Long Set Biru Garis', 'lazy-pajamas-long-set-biru-garis', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wu-mma6nqjqmnt490', 'Rp524.000', '524000.00', 1, 0, 1, 'https://s.shopee.co.id/5L9IxttYEY', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 09:15:09'),
(7, 2, 8, 'Klamby Bobok Piyama Rayon Lengan Panjang Motif Kekinian', 'klamby-bobok-piyama-rayon-lengan-panjang-motif-kekinian', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wl-mmpg8h6217uq13', 'Rp68.950', '68950.00', 1, 0, 2, 'https://s.shopee.co.id/7pqdwUk2A5', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(8, 3, 8, 'Prass Official Setelan Rayon Lengan Pendek Kancing Depan', 'prass-official-setelan-rayon-lengan-pendek-kancing-depan', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wg-moayml0q40zv7b', 'Rp67.000', '67000.00', 1, 0, 3, 'https://s.shopee.co.id/1VwaOrI2kR', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(9, 4, 8, 'Aurae Mikaila Set Piyama Stripe Katun Lengan Pendek', 'aurae-mikaila-set-piyama-stripe-katun-lengan-pendek', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224u-mjzg9i6i92q085', 'Rp130.680', '130680.00', 1, 0, 4, 'https://s.shopee.co.id/gNTPKLDRK', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(10, 5, 8, 'Hanalisa Jeans Piyama Vneck Rayon Kancing Depan', 'hanalisa-jeans-piyama-vneck-rayon-kancing-depan', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-81zuu-mmwkfkeacbnoe5', 'Rp53.899', '53899.00', 1, 0, 5, 'https://s.shopee.co.id/qgtbdKa6N', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(11, 6, 8, 'Oriana Piyama Palmer Poly Bamboo Pria', 'oriana-piyama-palmer-poly-bamboo-pria', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wl-mndps3xaisqt5a', 'Rp114.000', '114000.00', 1, 0, 6, 'https://s.shopee.co.id/60Ozl8Dlef', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(12, 7, 8, 'Dianputri Setelan Piyama Rayon Resleting Depan', 'dianputri-setelan-piyama-rayon-resleting-depan', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224y-mhvkh49unoxu98', 'Rp95.934', '95934.00', 1, 0, 7, 'https://s.shopee.co.id/9pbiKAu9jP', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(13, 8, 8, 'Brasay Set Baju Tidur Tanktop Camisole Wanita', 'brasay-set-baju-tidur-tanktop-camisole-wanita', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r98w-lqyln30i59eh76', 'Rp31.499', '31499.00', 1, 0, 8, 'https://s.shopee.co.id/9zv8WTtWOS', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(14, 9, 8, 'Mizzzee Piyama Satin Celana Pendek Motif Bunga', 'mizzzee-piyama-satin-celana-pendek-motif-bunga', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-824hv-mesej0pzseme79', 'Rp71.479', '71479.00', 1, 0, 9, 'https://s.shopee.co.id/6AiPxRD8Jg', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(15, 10, 8, 'Aiylian Piyama Set Tanktop Vintage Wanita', 'aiylian-piyama-set-tanktop-vintage-wanita', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ras8-m3q29187xxu88b', 'Rp83.000', '83000.00', 1, 0, 10, 'https://s.shopee.co.id/9UyrvZ0RYO', NULL, 0, 0, '2026-06-05 07:32:55', '2026-06-05 07:32:55'),
(16, 11, 4, 'Apple iPhone 15', 'apple-iphone-15', NULL, 'https://down-id.img.susercontent.com/file/id-11134201-7r98t-lmpk42301ctbbc', 'Rp12.299.000', '12299000.00', 1, 0, 11, 'https://s.shopee.co.id/70HX1Va0ND', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(17, 12, 4, 'Apple iPhone 15 128GB Blue', 'apple-iphone-15-128gb-blue', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ra0j-mdr8co9v0e27f7', 'Rp12.999.000', '12999000.00', 1, 0, 12, 'https://s.shopee.co.id/4ftcFDtKy0', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(18, 13, 4, 'Apple iPhone 15 128GB Black', 'apple-iphone-15-128gb-black', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ra0u-mdr8co9v8tgv07', 'Rp12.999.000', '12999000.00', 1, 0, 13, 'https://s.shopee.co.id/5Apsq8rQx9', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(19, 14, 4, 'Apple iPhone 16', 'apple-iphone-16', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rash-m12fwkovdw2s3b', 'Rp14.799.000', '14799000.00', 1, 0, 14, 'https://s.shopee.co.id/8fPl0ZTezZ', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(20, 15, 4, 'Apple iPhone 16 Plus', 'apple-iphone-16-plus', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rasg-m12fwkovjhxm47', 'Rp19.999.000', '19999000.00', 1, 0, 15, 'https://s.shopee.co.id/Lkd5GN26k', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(21, 16, 4, 'Apple iPhone 16 Pro Max', 'apple-iphone-16-pro-max', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ra0m-mdr868y1hqnj03', 'Rp23.999.000', '23999000.00', 1, 0, 16, 'https://s.shopee.co.id/7pqe12q57L', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(22, 17, 4, 'Apple iPhone 17', 'apple-iphone-17', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztk-mf7zk0am5a18da', 'Rp17.999.000', '17999000.00', 1, 0, 17, 'https://s.shopee.co.id/8pjBCsT1ea', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(23, 18, 4, 'Apple iPhone 17 Pro', 'apple-iphone-17-pro', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztf-mf839w1t2o7fe5', 'Rp24.999.000', '24999000.00', 1, 0, 18, 'https://s.shopee.co.id/7fXDojqiSI', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(24, 19, 4, 'Apple iPhone 17 Pro Max', 'apple-iphone-17-pro-max', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztc-mfat7uibdxxla7', 'Rp26.999.000', '26999000.00', 1, 1, 19, 'https://s.shopee.co.id/9AM1bURkyg', 'https://vt.tokopedia.com/t/ZS92bEoa7fvwV-tbzIS/', 0, 1, '2026-06-05 08:22:53', '2026-06-05 23:57:29'),
(25, 20, 4, 'Apple iPhone Air', 'apple-iphone-air', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztj-mfatwg9d9yj370', 'Rp16.999.000', '16999000.00', 1, 0, 20, 'https://s.shopee.co.id/qgtgBL85t', NULL, 0, 0, '2026-06-05 08:22:53', '2026-06-05 08:22:53'),
(26, 21, 8, 'M&S - Dress Wanita - Mesh Jersey Printed Midi Column Dress', 'ms-dress-wanita-mesh-jersey-printed-midi-column-dress', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7rd5s-lv09hhs1o27p95', 'Rp200.000', '200000.00', 1, 0, 21, 'https://shopee.co.id/M-S-Dress-Wanita-Mesh-Jersey-Printed-Midi-Column-Dress-i.255178178.24378971783?extraParams=%7B%22display_model_id%22%3A236307606497%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(27, 22, 8, 'M&S - Dress Wanita - Linen Rich Tie Neck Knee Length Shift Dress', 'ms-dress-wanita-linen-rich-tie-neck-knee-length-shift-dress', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7rd3q-m6xnl4axvdpd72', 'Rp200.000', '200000.00', 1, 0, 22, 'https://shopee.co.id/M-S-Dress-Wanita-Linen-Rich-Tie-Neck-Knee-Length-Shift-Dress-i.255178178.27524013382?extraParams=%7B%22display_model_id%22%3A247506213599%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(28, 23, 8, 'M&S - Dress Wanita - Printed Collared Belted Midi Shirt Dress', 'ms-dress-wanita-printed-collared-belted-midi-shirt-dress', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7rbkz-m5cspwitcnrsf6', 'Rp320.000', '320000.00', 1, 0, 23, 'https://shopee.co.id/M-S-Dress-Wanita-Printed-Collared-Belted-Midi-Shirt-Dress-i.255178178.29724407511?extraParams=%7B%22display_model_id%22%3A195748912219%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(29, 24, 8, 'M&S - Dress Wanita - Mesh Jersey Midi Column Dress', 'ms-dress-wanita-mesh-jersey-midi-column-dress', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7rd6u-lv09bhesap5597', 'Rp200.000', '200000.00', 1, 0, 24, 'https://shopee.co.id/M-S-Dress-Wanita-Mesh-Jersey-Midi-Column-Dress-i.255178178.24978966278?extraParams=%7B%22display_model_id%22%3A176460108775%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(30, 25, 8, 'DR8032 Dress Wanita Korean Sexy Wrap Slim Body  Elegant S/M/L/XL', 'dr8032-dress-wanita-korean-sexy-wrap-slim-body-elegant-smlxl', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r98p-lxc4840aixf067', 'Rp98.999', '98999.00', 1, 0, 25, 'https://shopee.co.id/DR8032-Dress-Wanita-Korean-Sexy-Wrap-Slim-Body-Elegant-S-M-L-XL-i.467375107.25533115740?extraParams=%7B%22display_model_id%22%3A39440175517%2C%22model_selection_logic%22%3A3%7D&sp_atk=40085ca1-c444-4a0f-baf8-513c4ba86524&xptdk=40085ca1-c444-4a0f-baf8-513c4ba86524', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(31, 26, 8, '[BEST SELLER] Momiasi – Yuki Home Dress Kimono – Daster Busui Lahiran Friendly- Maternity Hospital Kimono Rayon', 'best-seller-momiasi-yuki-home-dress-kimono-daster-busui-lahiran-friendly-maternity-hospital-kimono-rayon', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224q-mjxwv803dwch80', 'Rp209.000', '209000.00', 1, 0, 26, 'https://shopee.co.id/-BEST-SELLER-Momiasi-%E2%80%93-Yuki-Home-Dress-Kimono-%E2%80%93-Daster-Busui-Lahiran-Friendly-Maternity-Hospital-Kimono-Rayon-i.305637477.29312406390?extraParams=%7B%22display_model_id%22%3A139080315689%2C%22model_selection_logic%22%3A3%7D&sp_atk=bc578ef0-eba1-468e-8081-7ac34ade6fca&xptdk=bc578ef0-eba1-468e-8081-7ac34ade6fca', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(32, 27, 8, 'EMITA BLOOM Blue Floral Dress Biru Muda Summer Elegant Long Dress Pantai Wanita Korea Party import baju dress body press korean style terbaru 2026 kekinian   XS-4XL', 'emita-bloom-blue-floral-dress-biru-muda-summer-elegant-long-dress-pantai-wanita-korea-party-import-baju-dress-body-press-korean-style-terbaru-2026-kekinian-xs-4xl', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r98q-lzyyrqiydnhca1', 'Rp139.000', '139000.00', 1, 0, 27, 'https://shopee.co.id/EMITA-BLOOM-Blue-Floral-Dress-Biru-Muda-Summer-Elegant-Long-Dress-Pantai-Wanita-Korea-Party-import-baju-dress-body-press-korean-style-terbaru-2026-kekinian-XS-4XL-i.1276101276.27904977393?extraParams=%7B%22display_model_id%22%3A127978996560%2C%22model_selection_logic%22%3A3%7D&sp_atk=922644e4-1b16-44fd-be60-b65f64a4b530&xptdk=922644e4-1b16-44fd-be60-b65f64a4b530', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(33, 28, 8, 'Leenbenka Adeline Polo Shirt Dress Garis-Garis Nyaman', 'leenbenka-adeline-polo-shirt-dress-garis-garis-nyaman', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wq-moi6ghxv1vd583', 'Rp99.000', '99000.00', 1, 0, 28, 'https://shopee.co.id/Leenbenka-Adeline-Polo-Shirt-Dress-Garis-Garis-Nyaman-i.178392881.14679894895?extraParams=%7B%22display_model_id%22%3A68713080422%2C%22model_selection_logic%22%3A3%7D&sp_atk=f5aa0c01-cca8-44a4-8422-de5635f089cc&xptdk=f5aa0c01-cca8-44a4-8422-de5635f089cc', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(34, 29, 8, 'Newlan QZ070 Velvet Bodycon Dress  Korean Midi Dress Short Sleeves Women Dress Midi Lengan Pendek Korean Long dress / Gaun terusan panjang / Dress Bodycon Elegan Harper sabrina bodycon dress Maxi Dress Long Dress Bodycon Pesta Kondangan One Shoulder', 'newlan-qz070-velvet-bodycon-dress-korean-midi-dress-short-sleeves-women-dress-midi-lengan-pendek-korean-long-dress-gaun-terusan-panjang-dress-bodycon-elegan-harper-sabrina-bodycon-dress-maxi-dress-long-dress-bodycon-pesta-kondangan-one-shoulder', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7qvf9-lhx3r87gh588ef', 'Rp87.274', '87274.00', 1, 0, 29, 'https://shopee.co.id/Newlan-QZ070-Velvet-Bodycon-Dress-Korean-Midi-Dress-Short-Sleeves-Women-Dress-Midi-Lengan-Pendek-Korean-Long-dress-Gaun-terusan-panjang-Dress-Bodycon-Elegan-Harper-sabrina-bodycon-dress-Maxi-Dress-Long-Dress-Bodycon-Pesta-Kondangan-One-Shoulder-i.410859866.14297610545?extraParams=%7B%22display_model_id%22%3A158244698277%2C%22model_selection_logic%22%3A3%7D&sp_atk=365cf6dc-b4d4-4b7c-aad0-9bc183c33df5&xptdk=365cf6dc-b4d4-4b7c-aad0-9bc183c33df5', NULL, 0, 0, '2026-06-09 01:48:23', '2026-06-09 01:48:23'),
(35, 30, 8, 'Minimal Ivani Stripe Long Dress R Grey Offwhite', 'minimal-ivani-stripe-long-dress-r-grey-offwhite', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81zto-mf3wlebho45ka9', 'Rp136.455', '136455.00', 1, 0, 30, 'https://shopee.co.id/Minimal-Ivani-Stripe-Long-Dress-R-Grey-Offwhite-i.23731267.21826801990?extraParams=%7B%22display_model_id%22%3A145261100827%2C%22model_selection_logic%22%3A3%7D&sp_atk=f27929b8-be13-4b8e-bd19-9adf4b434120&xptdk=f27929b8-be13-4b8e-bd19-9adf4b434120', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(36, 31, 8, 'EMITA BLOOM dress orange floral long dress backless wanita kekinian import terbaru 2026 baju dress sexy pantai bunga bunga press body korea style', 'emita-bloom-dress-orange-floral-long-dress-backless-wanita-kekinian-import-terbaru-2026-baju-dress-sexy-pantai-bunga-bunga-press-body-korea-style', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7rdym-m0n2sps8rcy640', 'Rp129.900', '129900.00', 1, 0, 31, 'https://shopee.co.id/EMITA-BLOOM-dress-orange-floral-long-dress-backless-wanita-kekinian-import-terbaru-2026-baju-dress-sexy-pantai-bunga-bunga-press-body-korea-style-i.1276101276.28262489771?extraParams=%7B%22display_model_id%22%3A185421941617%2C%22model_selection_logic%22%3A3%7D&sp_atk=b70cf25a-8fbd-4850-82f1-e68c5db11693&xptdk=b70cf25a-8fbd-4850-82f1-e68c5db11693', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(37, 32, 8, 'YIMITA summer biru flowy midi dress pantai wanita korean style tanpa lengan motif bunga dress jumbo pesta halter fairy backless kekinian elegan lebaran dress terbaru 2026 press body', 'yimita-summer-biru-flowy-midi-dress-pantai-wanita-korean-style-tanpa-lengan-motif-bunga-dress-jumbo-pesta-halter-fairy-backless-kekinian-elegan-lebaran-dress-terbaru-2026-press-body', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ra0o-mbc5kudmgtlic8', 'Rp109.000', '109000.00', 1, 0, 32, 'https://shopee.co.id/YIMITA-summer-biru-flowy-midi-dress-pantai-wanita-korean-style-tanpa-lengan-motif-bunga-dress-jumbo-pesta-halter-fairy-backless-kekinian-elegan-lebaran-dress-terbaru-2026-press-body-i.1404466352.40152461112?extraParams=%7B%22display_model_id%22%3A270201659667%2C%22model_selection_logic%22%3A3%7D&sp_atk=08ccb414-a31e-4356-a8e4-4ba1661db732&xptdk=08ccb414-a31e-4356-a8e4-4ba1661db732', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(38, 33, 8, 'EMITA BLOOM summer white midi dress kekinian baju putih gereja pantai wanita kekinian muslimah import korea style party elegan evening dress terbaru 2026', 'emita-bloom-summer-white-midi-dress-kekinian-baju-putih-gereja-pantai-wanita-kekinian-muslimah-import-korea-style-party-elegan-evening-dress-terbaru-2026', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ras8-m15i9o36dfbn49', 'Rp139.000', '139000.00', 1, 0, 33, 'https://shopee.co.id/EMITA-BLOOM-summer-white-midi-dress-kekinian-baju-putih-gereja-pantai-wanita-kekinian-muslimah-import-korea-style-party-elegan-evening-dress-terbaru-2026-i.1276101276.28256131085?extraParams=%7B%22display_model_id%22%3A49795664677%2C%22model_selection_logic%22%3A3%7D&sp_atk=b9b07d03-581e-445f-821f-ec9014c1af82&xptdk=b9b07d03-581e-445f-821f-ec9014c1af82', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(39, 34, 8, '99kOutlet Long Dress Bodycon Plain Long Sleeve Square Neck 3282 (S/M/L/XL)', '99koutlet-long-dress-bodycon-plain-long-sleeve-square-neck-3282-smlxl', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224y-mjdxkyrtacqs96', 'Rp99.900', '99900.00', 1, 0, 34, 'https://shopee.co.id/99kOutlet-Long-Dress-Bodycon-Plain-Long-Sleeve-Square-Neck-3282-(S-M-L-XL)-i.1261537001.29477029712?extraParams=%7B%22display_model_id%22%3A198236827246%2C%22model_selection_logic%22%3A3%7D&sp_atk=6417787f-1143-4686-b154-1b9cb7dd0de8&xptdk=6417787f-1143-4686-b154-1b9cb7dd0de8', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(40, 35, 8, 'EMITA BLOOM summer mini dress hitam pendek wanita kekinian korean style black dress halloween party night inner dress tanpa lengan terbaru 2026 kondangan outfit', 'emita-bloom-summer-mini-dress-hitam-pendek-wanita-kekinian-korean-style-black-dress-halloween-party-night-inner-dress-tanpa-lengan-terbaru-2026-kondangan-outfit', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rbkb-m6golrfne1pmca', 'Rp79.000', '79000.00', 1, 0, 35, 'https://shopee.co.id/EMITA-BLOOM-summer-mini-dress-hitam-pendek-wanita-kekinian-korean-style-black-dress-halloween-party-night-inner-dress-tanpa-lengan-terbaru-2026-kondangan-outfit-i.1276101276.28409860598?extraParams=%7B%22display_model_id%22%3A118444587642%2C%22model_selection_logic%22%3A3%7D&sp_atk=1e4a4ace-ecc7-446e-9e47-3306068bfc7f&xptdk=1e4a4ace-ecc7-446e-9e47-3306068bfc7f', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(41, 36, 8, 'Newlan QZ081 Butterfly Sleeve Cream Midi Dress with Slit - Dress Casual Kasual/Korean Dress Korea Fashion Outfit/Daisy Dress Bunga/Summer Dress Pantai Beach/Party Dress/Korean midi dress square neck motif flower/Gaun wanita murah bergaya Korea motif bunga', 'newlan-qz081-butterfly-sleeve-cream-midi-dress-with-slit-dress-casual-kasualkorean-dress-korea-fashion-outfitdaisy-dress-bungasummer-dress-pantai-beachparty-dresskorean-midi-dress-square-neck-motif-flowergaun-wanita-murah-bergaya-korea-motif-bunga', NULL, 'https://down-id.img.susercontent.com/file/sg-11134201-7qvcy-ljksv2zaww0a8c', 'Rp108.800', '108800.00', 1, 0, 36, 'https://shopee.co.id/Newlan-QZ081-Butterfly-Sleeve-Cream-Midi-Dress-with-Slit-Dress-Casual-Kasual-Korean-Dress-Korea-Fashion-Outfit-Daisy-Dress-Bunga-Summer-Dress-Pantai-Beach-Party-Dress-Korean-midi-dress-square-neck-motif-flower-Gaun-wanita-murah-bergaya-Korea-motif-bunga-i.410859866.22049237005?extraParams=%7B%22display_model_id%22%3A206906096822%2C%22model_selection_logic%22%3A3%7D&sp_atk=3e5511a7-3c11-420e-a21b-905a24a6dda7&xptdk=3e5511a7-3c11-420e-a21b-905a24a6dda7', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(42, 37, 8, 'Leenbenka Diora Dress Wanita Knit Premium Bumil Friendly', 'leenbenka-diora-dress-wanita-knit-premium-bumil-friendly', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r990-lyajwxkt197f94', 'Rp102.000', '102000.00', 1, 0, 37, 'https://shopee.co.id/Leenbenka-Diora-Dress-Wanita-Knit-Premium-Bumil-Friendly-i.178392881.29754655264?extraParams=%7B%22display_model_id%22%3A166560452567%2C%22model_selection_logic%22%3A3%7D&sp_atk=16c40740-266c-46d8-bbf2-c8255ae00e40&xptdk=16c40740-266c-46d8-bbf2-c8255ae00e40', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(43, 38, 8, 'Cohan DR010  Dresses Hitam Panjang Lengan Pendek Dinner Fashion Full Body  Black S/M/L/XL/2XL', 'cohan-dr010-dresses-hitam-panjang-lengan-pendek-dinner-fashion-full-body-black-smlxl2xl', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r98y-lvwmsnes70ny3c', 'Rp129.000', '129000.00', 1, 0, 38, 'https://shopee.co.id/Cohan-DR010-Dresses-Hitam-Panjang-Lengan-Pendek-Dinner-Fashion-Full-Body-Black-S-M-L-XL-2XL-i.467375107.21384553535?extraParams=%7B%22display_model_id%22%3A207057411124%2C%22model_selection_logic%22%3A3%7D&sp_atk=30e8b157-a142-4844-a43f-b5a8dc49708b&xptdk=30e8b157-a142-4844-a43f-b5a8dc49708b', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(44, 39, 8, 'EMITA BLOOM purple dress party lace dress Serut press body tanpa lengan floral long dress cantik ke pantai wanita kekinian korean style terbaru 2026 dress pesta mewah elegan kondangan', 'emita-bloom-purple-dress-party-lace-dress-serut-press-body-tanpa-lengan-floral-long-dress-cantik-ke-pantai-wanita-kekinian-korean-style-terbaru-2026-dress-pesta-mewah-elegan-kondangan', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rasd-m4a2opgbwqsj6f', 'Rp129.000', '129000.00', 1, 0, 39, 'https://shopee.co.id/EMITA-BLOOM-purple-dress-party-lace-dress-Serut-press-body-tanpa-lengan-floral-long-dress-cantik-ke-pantai-wanita-kekinian-korean-style-terbaru-2026-dress-pesta-mewah-elegan-kondangan-i.1276101276.25735906050?extraParams=%7B%22display_model_id%22%3A217797621912%2C%22model_selection_logic%22%3A3%7D&sp_atk=e80fa3cf-17ab-48dc-936f-e62c6773f841&xptdk=e80fa3cf-17ab-48dc-936f-e62c6773f841', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(45, 40, 8, 'FOREVER SWEET Korean Style Home Dress Cotton Comfort Daster Midi Wanita Daily Wear - Midi Dress Wanita Casual', 'forever-sweet-korean-style-home-dress-cotton-comfort-daster-midi-wanita-daily-wear-midi-dress-wanita-casual', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-82251-mgximeix63gvfc', 'Rp115.240', '115240.00', 1, 0, 40, 'https://shopee.co.id/FOREVER-SWEET-Korean-Style-Home-Dress-Cotton-Comfort-Daster-Midi-Wanita-Daily-Wear-Midi-Dress-Wanita-Casual-i.612002131.19364745852?extraParams=%7B%22display_model_id%22%3A246744117908%2C%22model_selection_logic%22%3A3%7D&sp_atk=e688f66c-4b92-4ab4-b9e9-5fc623d7d9e3&xptdk=e688f66c-4b92-4ab4-b9e9-5fc623d7d9e3', NULL, 0, 0, '2026-06-09 01:48:24', '2026-06-09 01:48:24'),
(46, 41, 6, 'SUBSIDI POLYTRON Fox 200 Electric Sepeda Motor Listrik - Velora Black - FLASH SALE', 'subsidi-polytron-fox-200-electric-sepeda-motor-listrik-velora-black-flash-sale', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wp-mnclh34iovlwe4', 'Rp999.999.999', '999999999.00', 1, 0, 41, 'https://shopee.co.id/SUBSIDI-POLYTRON-Fox-200-Electric-Sepeda-Motor-Listrik-Velora-Black-FLASH-SALE-i.1028715472.51550492181?extraParams=%7B%22display_model_id%22%3A69947034105%2C%22model_selection_logic%22%3A3%7D&sp_atk=3e2d4c93-050d-4229-9c8c-b59c779fed5d&xptdk=3e2d4c93-050d-4229-9c8c-b59c779fed5d', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(47, 42, 6, 'U-Winfly T85 Motor Listrik 1500 WATT dengan Kecepatan Max 50KM/jam dan Jarak Tempuh 100KM', 'u-winfly-t85-motor-listrik-1500-watt-dengan-kecepatan-max-50kmjam-dan-jarak-tempuh-100km', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-82251-mj7trvncl43n88', 'Rp10.339.000', '10339000.00', 1, 0, 42, 'https://shopee.co.id/U-Winfly-T85-Motor-Listrik-1500-WATT-dengan-Kecepatan-Max-50KM-jam-dan-Jarak-Tempuh-100KM-i.102598934.42306798349?extraParams=%7B%22display_model_id%22%3A253592251376%2C%22model_selection_logic%22%3A3%7D&sp_atk=8ae61f35-9aa4-424e-a31f-4b864e1d2bbd&xptdk=8ae61f35-9aa4-424e-a31f-4b864e1d2bbd', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(48, 43, 6, 'READY STOK- POLYTRON FOX 350 Motor Listrik OTR JADETABEK - Banten - Jawa Tengah', 'ready-stok-polytron-fox-350-motor-listrik-otr-jadetabek-banten-jawa-tengah', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wi-mlbmb6zv8etg93', 'Rp17.050.000', '17050000.00', 1, 0, 43, 'https://shopee.co.id/READY-STOK-POLYTRON-FOX-350-Motor-Listrik-OTR-JADETABEK-Banten-Jawa-Tengah-i.1430971894.57251804313?extraParams=%7B%22display_model_id%22%3A262180648465%2C%22model_selection_logic%22%3A3%7D&sp_atk=581abd58-568a-4554-869d-0e63499467c9&xptdk=581abd58-568a-4554-869d-0e63499467c9', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(49, 44, 6, 'U-Winfly T90 Motor Listrik Power 3000W Range 100km dengan Ban Tubles & Suspensi Hidrolik', 'u-winfly-t90-motor-listrik-power-3000w-range-100km-dengan-ban-tubles-suspensi-hidrolik', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224u-mj7tf7vkpurn61', 'Rp13.269.000', '13269000.00', 1, 0, 44, 'https://shopee.co.id/U-Winfly-T90-Motor-Listrik-Power-3000W-Range-100km-dengan-Ban-Tubles-Suspensi-Hidrolik-i.102598934.29875043230?extraParams=%7B%22display_model_id%22%3A257575395208%2C%22model_selection_logic%22%3A3%7D&sp_atk=67e970e8-52b2-4f0d-866b-4125916085fb&xptdk=67e970e8-52b2-4f0d-866b-4125916085fb', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(50, 45, 6, 'VIAR EV1 - Sepeda Motor Listrik OTR JABODETABEK', 'viar-ev1-sepeda-motor-listrik-otr-jabodetabek', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224v-mil8r1u2uhvr2e', 'Rp12.620.000', '12620000.00', 1, 0, 45, 'https://shopee.co.id/VIAR-EV1-Sepeda-Motor-Listrik-OTR-JABODETABEK-i.405008109.23047238418?extraParams=%7B%22display_model_id%22%3A216856954113%2C%22model_selection_logic%22%3A3%7D&sp_atk=a02a872d-e49e-4f7a-a4a2-cb090c524275&xptdk=a02a872d-e49e-4f7a-a4a2-cb090c524275', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(51, 46, 6, 'Uwinfly M135H Motor Listrik 5000 Watt Range 180KM Dual Baterai Lithium 74V 30Ah', 'uwinfly-m135h-motor-listrik-5000-watt-range-180km-dual-baterai-lithium-74v-30ah', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wj-mmq8hawvv30oe2', 'Rp24.990.000', '24990000.00', 1, 0, 46, 'https://shopee.co.id/Uwinfly-M135H-Motor-Listrik-5000-Watt-Range-180KM-Dual-Baterai-Lithium-74V-30Ah-i.102598934.45658248810?extraParams=%7B%22display_model_id%22%3A400730983731%2C%22model_selection_logic%22%3A3%7D&sp_atk=8938acdc-9856-4804-86f0-b38b96df88dc&xptdk=8938acdc-9856-4804-86f0-b38b96df88dc', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(52, 47, 6, 'VIAR NX - Sepeda Motor Listrik OTR JABODETABEK', 'viar-nx-sepeda-motor-listrik-otr-jabodetabek', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224o-mil8r1u2qa6fa0', 'Rp10.650.000', '10650000.00', 1, 0, 47, 'https://shopee.co.id/VIAR-NX-Sepeda-Motor-Listrik-OTR-JABODETABEK-i.405008109.14499078777?extraParams=%7B%22display_model_id%22%3A108946742432%2C%22model_selection_logic%22%3A3%7D&sp_atk=a1894ea9-af1a-4185-9bed-288c06f17978&xptdk=a1894ea9-af1a-4185-9bed-288c06f17978', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(53, 48, 6, 'U-Winfly M100 Gen 3 Motor Listrik 5000W Range 120km Smart Key System Futuristik Double Cakram', 'u-winfly-m100-gen-3-motor-listrik-5000w-range-120km-smart-key-system-futuristik-double-cakram', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224t-mj7tn59sj3eo02', 'Rp18.849.000', '18849000.00', 1, 0, 48, 'https://shopee.co.id/U-Winfly-M100-Gen-3-Motor-Listrik-5000W-Range-120km-Smart-Key-System-Futuristik-Double-Cakram-i.102598934.27475033296?extraParams=%7B%22display_model_id%22%3A147999706853%2C%22model_selection_logic%22%3A3%7D&sp_atk=46ecf163-18cb-470f-9ea8-02b86e0134a1&xptdk=46ecf163-18cb-470f-9ea8-02b86e0134a1', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(54, 49, 6, 'POLYTRON Fox 500 - Buy to Own - Sepeda Motor Listrik - OTR  Aceh, Medan, Padang, Pekanbaru,Palembang, Lampung,Banjarmasin, Pontianak, Mataram, Manado', 'polytron-fox-500-buy-to-own-sepeda-motor-listrik-otr-aceh-medan-padang-pekanbarupalembang-lampungbanjarmasin-pontianak-mataram-manado', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822ws-mneby5gaugauad', 'Rp58.500.000', '58500000.00', 1, 0, 49, 'https://shopee.co.id/POLYTRON-Fox-500-Buy-to-Own-Sepeda-Motor-Listrik-OTR-Aceh-Medan-Padang-Pekanbaru-Palembang-Lampung-Banjarmasin-Pontianak-Mataram-Manado-i.1028715472.47159395676?extraParams=%7B%22display_model_id%22%3A365828957678%2C%22model_selection_logic%22%3A3%7D&sp_atk=47d9f944-548c-445c-904a-22cfc35bae5e&xptdk=47d9f944-548c-445c-904a-22cfc35bae5e', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(55, 50, 6, 'ALVA N3 NEXT GEN Sepeda Motor Listrik Berlangganan Baterai Sewa - Jabodetabek', 'alva-n3-next-gen-sepeda-motor-listrik-berlangganan-baterai-sewa-jabodetabek', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wo-mlon3audh81x4e', 'Rp16.790.000', '16790000.00', 1, 0, 50, 'https://shopee.co.id/ALVA-N3-NEXT-GEN-Sepeda-Motor-Listrik-Berlangganan-Baterai-Sewa-Jabodetabek-i.1430971894.49857081557?extraParams=%7B%22display_model_id%22%3A310630464733%2C%22model_selection_logic%22%3A3%7D&sp_atk=921cb5c4-1bac-4cd8-bb6f-b81b680cf764&xptdk=921cb5c4-1bac-4cd8-bb6f-b81b680cf764', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(56, 51, 6, 'POLYTRON Fox 500 Sepeda Motor Listrik - OTR Bali & Lombok', 'polytron-fox-500-sepeda-motor-listrik-otr-bali-lombok', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rasd-m4r4wpofaq3ab5', 'Rp40.500.000', '40500000.00', 1, 0, 51, 'https://shopee.co.id/POLYTRON-Fox-500-Sepeda-Motor-Listrik-OTR-Bali-Lombok-i.1028715472.28311589781?extraParams=%7B%22display_model_id%22%3A208129429779%2C%22model_selection_logic%22%3A3%7D&sp_atk=10d3c47b-413b-4bec-aa26-7601c7824f11&xptdk=10d3c47b-413b-4bec-aa26-7601c7824f11', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(57, 52, 6, 'POLYTRON Fox 200 Electric Sepeda Motor Listrik - OTR Jawa Barat & Jawa Timur', 'polytron-fox-200-electric-sepeda-motor-listrik-otr-jawa-barat-jawa-timur', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztf-me8po39tkuf414', 'Rp13.200.000', '13200000.00', 1, 0, 52, 'https://shopee.co.id/POLYTRON-Fox-200-Electric-Sepeda-Motor-Listrik-OTR-Jawa-Barat-Jawa-Timur-i.1028715472.44167484903?extraParams=%7B%22display_model_id%22%3A291441975795%2C%22model_selection_logic%22%3A3%7D&sp_atk=08b5806a-adca-47af-9098-ce83213f41f0&xptdk=08b5806a-adca-47af-9098-ce83213f41f0', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(58, 53, 6, 'Polytron Fox 350 - Buy to Own - Electric Sepeda Motor Listrik - OTR Jawa Barat & Jawa Timur', 'polytron-fox-350-buy-to-own-electric-sepeda-motor-listrik-otr-jawa-barat-jawa-timur', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224w-mhu04t4ujdaa32', 'Rp30.000.000', '30000000.00', 1, 0, 53, 'https://shopee.co.id/Polytron-Fox-350-Buy-to-Own-Electric-Sepeda-Motor-Listrik-OTR-Jawa-Barat-Jawa-Timur-i.1028715472.52202566351?extraParams=%7B%22display_model_id%22%3A325248014004%2C%22model_selection_logic%22%3A3%7D&sp_atk=ff4c8808-b83f-412b-895f-d205a6f59207&xptdk=ff4c8808-b83f-412b-895f-d205a6f59207', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(59, 54, 6, '[Motor Listrik] TVS Motor iQube Electric S - Mercury Grey', 'motor-listrik-tvs-motor-iqube-electric-s-mercury-grey', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wp-moys8z28hlog11', 'Rp29.400.000', '29400000.00', 1, 0, 54, 'https://shopee.co.id/-Motor-Listrik-TVS-Motor-iQube-Electric-S-Mercury-Grey-i.954180726.27701263624?extraParams=%7B%22display_model_id%22%3A290433031166%2C%22model_selection_logic%22%3A3%7D&sp_atk=b6db92d8-ce41-4d84-8d05-a0ad1516f8d2&xptdk=b6db92d8-ce41-4d84-8d05-a0ad1516f8d2', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(60, 55, 6, 'KORVO Sepeda Listrik /Kendaraan Listrik Mewah Kelas Atas 35KM/H/ Sepeda Listrik Motor 500W 48V/Motor listrik Sepeda listrik exotic Sepeda listrik', 'korvo-sepeda-listrik-kendaraan-listrik-mewah-kelas-atas-35kmh-sepeda-listrik-motor-500w-48vmotor-listrik-sepeda-listrik-exotic-sepeda-listrik', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wl-mlvgvhuiugb385', 'Rp3.464.010', '3464010.00', 1, 0, 55, 'https://shopee.co.id/KORVO-Sepeda-Listrik-Kendaraan-Listrik-Mewah-Kelas-Atas-35KM-H-Sepeda-Listrik-Motor-500W-48V-Motor-listrik-Sepeda-listrik-exotic-Sepeda-listrik-i.1650228005.54307111011?extraParams=%7B%22display_model_id%22%3A430675940307%2C%22model_selection_logic%22%3A3%7D&sp_atk=79f2a73f-5506-4c2e-85d2-6afca295c5ad&xptdk=79f2a73f-5506-4c2e-85d2-6afca295c5ad', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(61, 56, 6, 'Uwinfly M90E (Motor Listrik), Range 90km, Quick Charge, Fast Swap, Li60v/24Ah, Motor Power 1500W, Smart U-Connect', 'uwinfly-m90e-motor-listrik-range-90km-quick-charge-fast-swap-li60v24ah-motor-power-1500w-smart-u-connect', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-82250-mj9ed0szf7r83f', 'Rp11.849.000', '11849000.00', 1, 0, 56, 'https://shopee.co.id/Uwinfly-M90E-(Motor-Listrik)-Range-90km-Quick-Charge-Fast-Swap-Li60v-24Ah-Motor-Power-1500W-Smart-U-Connect-i.102598934.23034481877?extraParams=%7B%22display_model_id%22%3A221978116651%2C%22model_selection_logic%22%3A3%7D&sp_atk=089de61f-762b-46d5-9f2d-1ed00ed0c438&xptdk=089de61f-762b-46d5-9f2d-1ed00ed0c438', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(62, 57, 6, 'Polytron Fox 350 - Buy to Own - Electric Sepeda Motor Listrik - OTR Jawa Tengah & Yogyakarta', 'polytron-fox-350-buy-to-own-electric-sepeda-motor-listrik-otr-jawa-tengah-yogyakarta', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224w-mhtxbf9wk9aaca', 'Rp29.500.000', '29500000.00', 1, 0, 57, 'https://shopee.co.id/Polytron-Fox-350-Buy-to-Own-Electric-Sepeda-Motor-Listrik-OTR-Jawa-Tengah-Yogyakarta-i.1028715472.44852580863?extraParams=%7B%22display_model_id%22%3A410247757921%2C%22model_selection_logic%22%3A3%7D&sp_atk=3b1c252a-22aa-4f47-a9ca-ec43eb4a9281&xptdk=3b1c252a-22aa-4f47-a9ca-ec43eb4a9281', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(63, 58, 6, 'POLYTRON Fox 500 Sepeda Motor Listrik - OTR Jadetabek - Banten', 'polytron-fox-500-sepeda-motor-listrik-otr-jadetabek-banten', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rbk0-magxx3k2rfcbe1', 'Rp39.600.000', '39600000.00', 1, 0, 58, 'https://shopee.co.id/POLYTRON-Fox-500-Sepeda-Motor-Listrik-OTR-Jadetabek-Banten-i.1028715472.27761594137?extraParams=%7B%22display_model_id%22%3A138050299579%2C%22model_selection_logic%22%3A3%7D&sp_atk=e106275f-4855-4a47-945d-bb5bc2fa329e&xptdk=e106275f-4855-4a47-945d-bb5bc2fa329e', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(64, 59, 6, 'Polytron Fox 350 - Buy to Own - Electric Sepeda Motor Listrik - OTR Aceh, Medan, Palembang, Banjarmasin, Samarinda, Mataram, Manado, Ternate', 'polytron-fox-350-buy-to-own-electric-sepeda-motor-listrik-otr-aceh-medan-palembang-banjarmasin-samarinda-mataram-manado-ternate', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224x-mhu5ryfxay2u6f', 'Rp31.000.000', '31000000.00', 1, 0, 59, 'https://shopee.co.id/Polytron-Fox-350-Buy-to-Own-Electric-Sepeda-Motor-Listrik-OTR-Aceh-Medan-Palembang-Banjarmasin-Samarinda-Mataram-Manado-Ternate-i.1028715472.57752572514?extraParams=%7B%22display_model_id%22%3A355248629726%2C%22model_selection_logic%22%3A3%7D&sp_atk=b70e6e77-6d2f-4652-8c5a-f9bf00e3ee72&xptdk=b70e6e77-6d2f-4652-8c5a-f9bf00e3ee72', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(65, 60, 6, '[Motor Listrik] TVS Motor iQube Electric S - Copper Bronze', 'motor-listrik-tvs-motor-iqube-electric-s-copper-bronze', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wr-moys8z28ketc3b', 'Rp29.400.000', '29400000.00', 1, 0, 60, 'https://shopee.co.id/-Motor-Listrik-TVS-Motor-iQube-Electric-S-Copper-Bronze-i.954180726.27051268213?extraParams=%7B%22display_model_id%22%3A305433045975%2C%22model_selection_logic%22%3A3%7D&sp_atk=747d98d3-c433-44eb-a80c-0c155935e103&xptdk=747d98d3-c433-44eb-a80c-0c155935e103', NULL, 0, 0, '2026-06-09 01:51:36', '2026-06-09 01:51:36'),
(66, 61, 7, 'SKINTIFIC - 2IN1 SKINCARE GLOWING SET | Niacinamide Brightening Daily Mask & Remover|  Miceller Water 2pcs Day Night Time 2pcs Deep Moisture Pink Duo Trio', 'skintific-2in1-skincare-glowing-set-niacinamide-brightening-daily-mask-remover-miceller-water-2pcs-day-night-time-2pcs-deep-moisture-pink-duo-trio', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224q-mi3tleoo66tg07', 'Rp72.900', '72900.00', 1, 0, 61, 'https://shopee.co.id/SKINTIFIC-2IN1-SKINCARE-GLOWING-SET-Niacinamide-Brightening-Daily-Mask-Remover-Miceller-Water-2pcs-Day-Night-Time-2pcs-Deep-Moisture-Pink-Duo-Trio-i.380266264.41177135981?extraParams=%7B%22display_model_id%22%3A216345519325%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(67, 62, 7, '[5PCS] SKINTIFIC Full Series Skincare Set - Facial Wash + Toner + Serum + Moisturizer + Sunscreen – Daily Skincare – Paket Perawatan Wajah Semua Jenis Kulit – Brightening, Dark Spot, Calming Acne, Skin Barrier, Glass Skin', '5pcs-skintific-full-series-skincare-set-facial-wash-toner-serum-moisturizer-sunscreen-daily-skincare-paket-perawatan-wajah-semua-jenis-kulit-brightening-dark-spot-calming-acne-skin-barrier-glass-skin', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wh-mma8qeemywoy14', 'Rp420.900', '420900.00', 1, 0, 62, 'https://shopee.co.id/-5PCS-SKINTIFIC-Full-Series-Skincare-Set-Facial-Wash-Toner-Serum-Moisturizer-Sunscreen-–-Daily-Skincare-–-Paket-Perawatan-Wajah-Semua-Jenis-Kulit-–-Brightening-Dark-Spot-Calming-Acne-Skin-Barrier-Glass-Skin-i.380266264.20381034869?extraParams=%7B%22display_model_id%22%3A69669735177%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(68, 63, 7, '[5pc]SKINTIFIC Essential Skincare Set – Paket Perawatan Wajah – Semua Jenis Kulit – Cleansing/Melembabkan/Barrier Repair/Brightening – Cleanser + Toner + Serum + Moisturizer + Sunscreen – Daily Skincare Routine Day & Night BPOM Official Store', '5pcskintific-essential-skincare-set-paket-perawatan-wajah-semua-jenis-kulit-cleansingmelembabkanbarrier-repairbrightening-cleanser-toner-serum-moisturizer-sunscreen-daily-skincare-routine-day-night-bpom-official-store', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224r-miocddz9tc74f1', 'Rp481.900', '481900.00', 1, 0, 63, 'https://shopee.co.id/-5pc-SKINTIFIC-Essential-Skincare-Set-–-Paket-Perawatan-Wajah-–-Semua-Jenis-Kulit-–-Cleansing-Melembabkan-Barrier-Repair-Brightening-–-Cleanser-Toner-Serum-Moisturizer-Sunscreen-–-Daily-Skincare-Routine-Day-Night-BPOM-Official-Store-i.380266264.58103691933?extraParams=%7B%22display_model_id%22%3A340351760923%2C%22model_selection_logic%22%3A3%7D', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(69, 64, 7, 'SKIN1004 Brightening Routine 4pcs Set (Tone Brightening Capsule Ampoule 100ml + Boosting Toner 210ml + Cleansing Gel Foam 125ml + Capsule Cream 75ml)', 'skin1004-brightening-routine-4pcs-set-tone-brightening-capsule-ampoule-100ml-boosting-toner-210ml-cleansing-gel-foam-125ml-capsule-cream-75ml', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224z-micc975xel8o39', 'Rp565.100', '565100.00', 1, 0, 64, 'https://shopee.co.id/SKIN1004-Brightening-Routine-4pcs-Set-(Tone-Brightening-Capsule-Ampoule-100ml-Boosting-Toner-210ml-Cleansing-Gel-Foam-125ml-Capsule-Cream-75ml)-i.555954448.28921426887?extraParams=%7B%22display_model_id%22%3A247313497040%2C%22model_selection_logic%22%3A3%7D&sp_atk=0049ea32-3bcc-4c46-a23a-78cd2e51fc3e&xptdk=0049ea32-3bcc-4c46-a23a-78cd2e51fc3e', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(70, 65, 7, 'Minimalist 10% Vitamin B5 Moisturizer | Pelembab Wajah Panthenol Bebas Minyak dengan Zinc | 50G', 'minimalist-10-vitamin-b5-moisturizer-pelembab-wajah-panthenol-bebas-minyak-dengan-zinc-50g', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7r990-lvvm4m5jiy2l2b', 'Rp90.000', '90000.00', 1, 0, 65, 'https://shopee.co.id/Minimalist-10-Vitamin-B5-Moisturizer-Pelembab-Wajah-Panthenol-Bebas-Minyak-dengan-Zinc-50G-i.939067949.23467511967?extraParams=%7B%22display_model_id%22%3A29379711656%2C%22model_selection_logic%22%3A3%7D&sp_atk=5716e388-7517-461f-8da7-2dd3879dd354&xptdk=5716e388-7517-461f-8da7-2dd3879dd354', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(71, 66, 7, 'ACNAWAY Advanced Mugwort Gel Mask– Face Mask Gel Masker Wajah untuk Kulit Berjerawat | Mencerahkan, Menghaluskan & Membersihkan Pori|Anti Kusam, Komedo & Minyak|Acne Skincare Brightening & Pore Care Masker Komedo Sleeping Mask Masker Acne', 'acnaway-advanced-mugwort-gel-mask-face-mask-gel-masker-wajah-untuk-kulit-berjerawat-mencerahkan-menghaluskan-membersihkan-porianti-kusam-komedo-minyakacne-skincare-brightening-pore-care-masker-komedo-sleeping-mask-masker-acne', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wk-mp5cidibzhu400', 'Rp102.999', '102999.00', 1, 0, 66, 'https://shopee.co.id/ACNAWAY-Advanced-Mugwort-Gel-Mask%E2%80%93-Face-Mask-Gel-Masker-Wajah-untuk-Kulit-Berjerawat-Mencerahkan-Menghaluskan-Membersihkan-Pori-Anti-Kusam-Komedo-Minyak-Acne-Skincare-Brightening-Pore-Care-Masker-Komedo-Sleeping-Mask-Masker-Acne-i.600850936.20320261259?extraParams=%7B%22display_model_id%22%3A258425230774%2C%22model_selection_logic%22%3A3%7D&sp_atk=822b9caf-6e9f-436f-b2cf-72e08ddb8d9c&xptdk=822b9caf-6e9f-436f-b2cf-72e08ddb8d9c', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(72, 67, 7, '(REAL 10% ADVANCE NIACINAMIDE) Hanasui Power Bright Expert Serum - Mencerahkan, Kurangi Bintik Hitam Bekas Jerawat', 'real-10-advance-niacinamide-hanasui-power-bright-expert-serum-mencerahkan-kurangi-bintik-hitam-bekas-jerawat', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7ra0g-mdmx69u1o2ic46', 'Rp71.145', '71145.00', 1, 0, 67, 'https://shopee.co.id/(REAL-10-ADVANCE-NIACINAMIDE)-Hanasui-Power-Bright-Expert-Serum-Mencerahkan-Kurangi-Bintik-Hitam-Bekas-Jerawat-i.129681299.20628506418?extraParams=%7B%22display_model_id%22%3A187987508530%2C%22model_selection_logic%22%3A3%7D&sp_atk=ed8ad44d-2385-4248-b212-ba619f8eae4c&xptdk=ed8ad44d-2385-4248-b212-ba619f8eae4c', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(73, 68, 7, 'ELFORMULA Intensive Peeling Solution - Peeling Serum Dark Spot Glass Skin Eksfoliasi Wajah Sel Kulit Mati AHA BHA PHA Glowing Smooth Skin Mencerahkan Kulit Halus Blackhead Brightening Cocok Kulit Berjerawat Komedo acne Glowing Retinol', 'elformula-intensive-peeling-solution-peeling-serum-dark-spot-glass-skin-eksfoliasi-wajah-sel-kulit-mati-aha-bha-pha-glowing-smooth-skin-mencerahkan-kulit-halus-blackhead-brightening-cocok-kulit-berjerawat-komedo-acne-glowing-retinol', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wn-mp7pgefize2q67', 'Rp84.900', '84900.00', 1, 0, 68, 'https://shopee.co.id/ELFORMULA-Intensive-Peeling-Solution-Peeling-Serum-Dark-Spot-Glass-Skin-Eksfoliasi-Wajah-Sel-Kulit-Mati-AHA-BHA-PHA-Glowing-Smooth-Skin-Mencerahkan-Kulit-Halus-Blackhead-Brightening-Cocok-Kulit-Berjerawat-Komedo-acne-Glowing-Retinol-i.600719961.15304662949?extraParams=%7B%22display_model_id%22%3A242400491007%2C%22model_selection_logic%22%3A3%7D&sp_atk=eefa85fd-f700-4be7-9793-3edc72741377&xptdk=eefa85fd-f700-4be7-9793-3edc72741377', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(74, 69, 7, 'Azarine Daily Men\'s Care [3 PCS] Facial Wash Moisturizer Sunscreen Paket Skincare Basic Pria untuk Kulit Sensitif Normal Berminyak Berjerawat', 'azarine-daily-mens-care-3-pcs-facial-wash-moisturizer-sunscreen-paket-skincare-basic-pria-untuk-kulit-sensitif-normal-berminyak-berjerawat', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224w-mhiifa9sefwo76', 'Rp120.000', '120000.00', 1, 0, 69, 'https://shopee.co.id/Azarine-Daily-Men\'s-Care-3-PCS-Facial-Wash-Moisturizer-Sunscreen-Paket-Skincare-Basic-Pria-untuk-Kulit-Sensitif-Normal-Berminyak-Berjerawat-i.80036545.50152108764?extraParams=%7B%22display_model_id%22%3A350205969763%2C%22model_selection_logic%22%3A2%7D&sp_atk=8d7346c1-bc16-4dab-92b4-3d268e843c03&xptdk=8d7346c1-bc16-4dab-92b4-3d268e843c03', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(75, 70, 7, 'ACNAWAY Mugwort Water Gel Moisturizer- Moisture Gel Pelembab Wajah Untuk Kulit Berjerawat Acne Friendly Melembapkan Wajah Sensitif Cooling Soothing Gel Untuk Kulit Kemerahan Acne Prone Daily Moist Anti Acne Cepat Menyerap Skincare Calming', 'acnaway-mugwort-water-gel-moisturizer-moisture-gel-pelembab-wajah-untuk-kulit-berjerawat-acne-friendly-melembapkan-wajah-sensitif-cooling-soothing-gel-untuk-kulit-kemerahan-acne-prone-daily-moist-anti-acne-cepat-menyerap-skincare-calming', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wu-mnxptawy8t8hc7', 'Rp102.999', '102999.00', 1, 0, 70, 'https://shopee.co.id/ACNAWAY-Mugwort-Water-Gel-Moisturizer-Moisture-Gel-Pelembab-Wajah-Untuk-Kulit-Berjerawat-Acne-Friendly-Melembapkan-Wajah-Sensitif-Cooling-Soothing-Gel-Untuk-Kulit-Kemerahan-Acne-Prone-Daily-Moist-Anti-Acne-Cepat-Menyerap-Skincare-Calming-i.600850936.20085052245?extraParams=%7B%22display_model_id%22%3A290086220869%2C%22model_selection_logic%22%3A3%7D&sp_atk=70b550be-81ac-41e7-bbe1-5b1ac43e7b74&xptdk=70b550be-81ac-41e7-bbe1-5b1ac43e7b74', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(76, 71, 7, 'Facetology Buy 4 Get 5 Paket Skincare Best Seller (Micellar, Serum, Moisturizer, Sunscreen) Get Free Facial gel 30ml', 'facetology-buy-4-get-5-paket-skincare-best-seller-micellar-serum-moisturizer-sunscreen-get-free-facial-gel-30ml', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wt-mnfgn3ud3qx47f', 'Rp159.999', '159999.00', 1, 0, 71, 'https://shopee.co.id/Facetology-Buy-4-Get-5-Paket-Skincare-Best-Seller-(Micellar-Serum-Moisturizer-Sunscreen)-Get-Free-Facial-gel-30ml-i.684531921.56707341527?extraParams=%7B%22display_model_id%22%3A335653487897%2C%22model_selection_logic%22%3A3%7D&sp_atk=9541bb86-d484-4c5a-a73e-e36eda897bf2&xptdk=9541bb86-d484-4c5a-a73e-e36eda897bf2', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(77, 72, 7, 'ELFORMULA Nia-Ceramide Bright Moisture Gel - Moisturizer Skincare Day Cream Night Cream Niacinamide Brightening & Hydrating Calming Skin Barrier Smooth Pelembab Wajah Kulit Cerah Krim Malam Krim Siang Mencerahkan Kulit Wajah', 'elformula-nia-ceramide-bright-moisture-gel-moisturizer-skincare-day-cream-night-cream-niacinamide-brightening-hydrating-calming-skin-barrier-smooth-pelembab-wajah-kulit-cerah-krim-malam-krim-siang-mencerahkan-kulit-wajah', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wl-mp7pgefgoikr99', 'Rp132.000', '132000.00', 1, 0, 72, 'https://shopee.co.id/ELFORMULA-Nia-Ceramide-Bright-Moisture-Gel-Moisturizer-Skincare-Day-Cream-Night-Cream-Niacinamide-Brightening-Hydrating-Calming-Skin-Barrier-Smooth-Pelembab-Wajah-Kulit-Cerah-Krim-Malam-Krim-Siang-Mencerahkan-Kulit-Wajah-i.600719961.52651217761?extraParams=%7B%22display_model_id%22%3A355162592087%2C%22model_selection_logic%22%3A3%7D&sp_atk=62a7f181-334a-4c98-890f-a45ca6012c66&xptdk=62a7f181-334a-4c98-890f-a45ca6012c66', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(78, 73, 7, 'BPOM Bioaqua 7x Ceramide Moisturizer cream Skin Barrier Repair Pemutih Wajah Day&Night Cream 20g', 'bpom-bioaqua-7x-ceramide-moisturizer-cream-skin-barrier-repair-pemutih-wajah-daynight-cream-20g', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rask-m45rngywlkmy02', 'Rp14.900', '14900.00', 1, 0, 73, 'https://shopee.co.id/BPOM-Bioaqua-7x-Ceramide-Moisturizer-cream-Skin-Barrier-Repair-Pemutih-Wajah-Day-Night-Cream-20g-i.297684022.28514716760?extraParams=%7B%22display_model_id%22%3A251827164098%2C%22model_selection_logic%22%3A3%7D&sp_atk=11ba7718-3289-4f1c-9173-2748aaa953db&xptdk=11ba7718-3289-4f1c-9173-2748aaa953db', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(79, 74, 7, 'ACNAWAY Hibiscus Gel Mask - Face Mask Gel Masker Wajah untuk Kulit Kusam & Dehidrasi | Mencerahkan, Melembapkan & Menghaluskan Kulit | Anti Kusam, Kulit Kering  | Masker Jerawat Skincare Gel Masker Acnaway Official Store', 'acnaway-hibiscus-gel-mask-face-mask-gel-masker-wajah-untuk-kulit-kusam-dehidrasi-mencerahkan-melembapkan-menghaluskan-kulit-anti-kusam-kulit-kering-masker-jerawat-skincare-gel-masker-acnaway-official-store', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wj-mp5cidic2az0a2', 'Rp118.000', '118000.00', 1, 0, 74, 'https://shopee.co.id/ACNAWAY-Hibiscus-Gel-Mask-Face-Mask-Gel-Masker-Wajah-untuk-Kulit-Kusam-Dehidrasi-Mencerahkan-Melembapkan-Menghaluskan-Kulit-Anti-Kusam-Kulit-Kering-Masker-Jerawat-Skincare-Gel-Masker-Acnaway-Official-Store-i.600850936.46161360500?extraParams=%7B%22display_model_id%22%3A395986417122%2C%22model_selection_logic%22%3A2%7D&sp_atk=72a6aef8-ab4b-42a2-b401-e83fe38be352&xptdk=72a6aef8-ab4b-42a2-b401-e83fe38be352', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(80, 75, 7, 'Implora Acne Spot Treatment | Antioksidan | Menenangkan Kulit Berjerawat | Pereda Jerawat', 'implora-acne-spot-treatment-antioksidan-menenangkan-kulit-berjerawat-pereda-jerawat', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224q-mkm6qwbb277r32', 'Rp17.500', '17500.00', 1, 0, 75, 'https://shopee.co.id/Implora-Acne-Spot-Treatment-Antioksidan-Menenangkan-Kulit-Berjerawat-Pereda-Jerawat-i.10960132.19688552119?extraParams=%7B%22display_model_id%22%3A194686315648%2C%22model_selection_logic%22%3A2%7D&sp_atk=f9c37bf6-3e6e-44b9-aa1b-ed3658640233&xptdk=f9c37bf6-3e6e-44b9-aa1b-ed3658640233', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(81, 76, 7, 'Glowsophy Watermelon Brightening Moisturizer Gel 100ml - Pelembab Wajah Ringan Mencerahkan Kulit dan Meratakan Warna Kulit Kusam Krim Siang dan Malam Perawatan Kulit Ekstrak Watermelon Pelembab Esensi Wajah Perawatan Kulit Pembersih', 'glowsophy-watermelon-brightening-moisturizer-gel-100ml-pelembab-wajah-ringan-mencerahkan-kulit-dan-meratakan-warna-kulit-kusam-krim-siang-dan-malam-perawatan-kulit-ekstrak-watermelon-pelembab-esensi-wajah-perawatan-kulit-pembersih', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-8224z-mi9nv7gqsflucb', 'Rp49.900', '49900.00', 1, 0, 76, 'https://shopee.co.id/Glowsophy-Watermelon-Brightening-Moisturizer-Gel-100ml-Pelembab-Wajah-Ringan-Mencerahkan-Kulit-dan-Meratakan-Warna-Kulit-Kusam-Krim-Siang-dan-Malam-Perawatan-Kulit-Ekstrak-Watermelon-Pelembab-Esensi-Wajah-Perawatan-Kulit-Pembersih-i.714408412.27755593773?extraParams=%7B%22display_model_id%22%3A188119223364%2C%22model_selection_logic%22%3A2%7D&sp_atk=3033ace3-7001-43ab-b0fa-87f3157c3af6&xptdk=3033ace3-7001-43ab-b0fa-87f3157c3af6', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47');
INSERT INTO `products` (`id`, `product_code`, `category_id`, `name`, `slug`, `image_path`, `image_url`, `display_price`, `price`, `is_active`, `is_featured`, `sort_order`, `shopee_url`, `tiktok_url`, `shopee_clicks`, `tiktok_clicks`, `created_at`, `updated_at`) VALUES
(82, 77, 7, 'Hanasui Glow All Day Set - Micellar Cleansing Water Glow Acne Expert Gentle Cleanser Bright Expert Serum Sunscreen SPF 50 & 30 Moisturizer Gel Membersihkan Menyegarkan dan Menghidrasi Mencerahkan Kulit', 'hanasui-glow-all-day-set-micellar-cleansing-water-glow-acne-expert-gentle-cleanser-bright-expert-serum-sunscreen-spf-50-30-moisturizer-gel-membersihkan-menyegarkan-dan-menghidrasi-mencerahkan-kulit', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-7rbkb-m6rqp1ji0achb1', 'Rp137.397', '137397.00', 1, 0, 77, 'https://shopee.co.id/Hanasui-Glow-All-Day-Set-Micellar-Cleansing-Water-Glow-Acne-Expert-Gentle-Cleanser-Bright-Expert-Serum-Sunscreen-SPF-50-30-Moisturizer-Gel-Membersihkan-Menyegarkan-dan-Menghidrasi-Mencerahkan-Kulit-i.129681299.29227878939?extraParams=%7B%22display_model_id%22%3A157706131605%2C%22model_selection_logic%22%3A3%7D&sp_atk=80f1c597-e7fe-410f-bf33-a286d9a554f3&xptdk=80f1c597-e7fe-410f-bf33-a286d9a554f3', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(83, 78, 7, 'ACNAWAY Mugwort Gel Facial Wash - Acne Friendly Gentle Cleanser Sabun Cuci Muka Untuk Kulit Berjerawat Sensitif Wajah Bersih Tidak Kering Face Wash Sabun Muka Oil Control Fungal Acne Safe Skincare Daily Cleanser All Skin Type Facewash', 'acnaway-mugwort-gel-facial-wash-acne-friendly-gentle-cleanser-sabun-cuci-muka-untuk-kulit-berjerawat-sensitif-wajah-bersih-tidak-kering-face-wash-sabun-muka-oil-control-fungal-acne-safe-skincare-daily-cleanser-all-skin-type-facewash', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wt-mmbzs1z8hkw221', 'Rp35.900', '35900.00', 1, 0, 78, 'https://shopee.co.id/ACNAWAY-Mugwort-Gel-Facial-Wash-Acne-Friendly-Gentle-Cleanser-Sabun-Cuci-Muka-Untuk-Kulit-Berjerawat-Sensitif-Wajah-Bersih-Tidak-Kering-Face-Wash-Sabun-Muka-Oil-Control-Fungal-Acne-Safe-Skincare-Daily-Cleanser-All-Skin-Type-Facewash-i.600850936.26152696153?extraParams=%7B%22display_model_id%22%3A49857020420%2C%22model_selection_logic%22%3A2%7D&sp_atk=b5e5e838-8978-4d7a-8c4f-dc93732f1167&xptdk=b5e5e838-8978-4d7a-8c4f-dc93732f1167', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(84, 79, 7, 'Hanasui Whitening Gold Serum - Cerah & Glowing Kurangi Bintik Hitam & Lawan Tanda Penuaan 4% Niacinamide & 2% Vitamin C', 'hanasui-whitening-gold-serum-cerah-glowing-kurangi-bintik-hitam-lawan-tanda-penuaan-4-niacinamide-2-vitamin-c', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-81ztp-mez9nhqz24uj86', 'Rp74.229', '74229.00', 1, 0, 79, 'https://shopee.co.id/Hanasui-Whitening-Gold-Serum-Cerah-Glowing-Kurangi-Bintik-Hitam-Lawan-Tanda-Penuaan-4-Niacinamide-2-Vitamin-C-i.129681299.2334973160?extraParams=%7B%22display_model_id%22%3A108287520424%2C%22model_selection_logic%22%3A3%7D&sp_atk=7c173bcc-5575-4916-b7c3-9b778392b7c1&xptdk=7c173bcc-5575-4916-b7c3-9b778392b7c1', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47'),
(85, 80, 7, 'UNITARY Sunscreen All Skin Solutions SPF50 PA++++ Physical | Untuk Kulit Kombinasi,Berminyak,Kering,Sensitif | Wajah Hypoallergenic,Kontrol Minyak,Waterproof[IN VIVO & NON COMEDOGENIC TESTED]BPOM', 'unitary-sunscreen-all-skin-solutions-spf50-pa-physical-untuk-kulit-kombinasiberminyakkeringsensitif-wajah-hypoallergenickontrol-minyakwaterproofin-vivo-non-comedogenic-testedbpom', NULL, 'https://down-id.img.susercontent.com/file/id-11134207-822wu-mo3gxrq2la0w72', 'Rp49.000', '49000.00', 1, 0, 80, 'https://shopee.co.id/UNITARY-Sunscreen-All-Skin-Solutions-SPF50-PA-Physical-Untuk-Kulit-Kombinasi-Berminyak-Kering-Sensitif-Wajah-Hypoallergenic-Kontrol-Minyak-Waterproof-IN-VIVO-NON-COMEDOGENIC-TESTED-BPOM-i.998472598.25370385362?extraParams=%7B%22display_model_id%22%3A178119454235%2C%22model_selection_logic%22%3A3%7D&sp_atk=50f01586-95a1-4810-b712-a92e7390ef4c&xptdk=50f01586-95a1-4810-b712-a92e7390ef4c', NULL, 0, 0, '2026-06-09 01:51:47', '2026-06-09 01:51:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VvG2Ao7SzdvDoxsCQc7iWvAHsn6dn5J7h4Wq3Eev', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJBSUF2ZTZxcDVZM1lsbE9wZEYyUDhVeTJKeFRNU2hnc1prM0ZVa2U4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcHJvZHVjdHMiLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLnJlc291cmNlcy5wcm9kdWN0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6ImY0M2VkNzJkNjE1MDg3Y2UxMTQ3NjZkYmFhZjRkNGJkZWJmNGUzNDBmMmYyYzc3ZTA0MGQ4Yjc4MGRhZmJiZGQiLCJ0YWJsZXMiOnsiODkyODY4MjM3YmY4ZjVmYmM1YTAwNTU1NGQzNWNhOTFfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZV9zcmMiLCJsYWJlbCI6IlByZXZpZXciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoidGl0bGUiLCJsYWJlbCI6Ikp1ZHVsIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRhcmdldF91cmwiLCJsYWJlbCI6IkxpbmsiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOmZhbHNlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiY2xpY2tzIiwibGFiZWwiOiJLbGlrIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InNvcnRfb3JkZXIiLCJsYWJlbCI6IlVydXRhbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpc19hY3RpdmUiLCJsYWJlbCI6IkFrdGlmIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InVwZGF0ZWRfYXQiLCJsYWJlbCI6IlVwZGF0ZSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9XSwiNTc5ZWUzMGIxZGE4NTNlZWZmMDM3MTYzZGUxNzAwODhfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1lIiwibGFiZWwiOiJOYW1hIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Imljb24iLCJsYWJlbCI6Iklrb24iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOmZhbHNlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicHJvZHVjdHNfY291bnQiLCJsYWJlbCI6IlByb2R1ayIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJzb3J0X29yZGVyIiwibGFiZWwiOiJVcnV0YW4iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfYWN0aXZlIiwibGFiZWwiOiJBa3RpZiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1cGRhdGVkX2F0IiwibGFiZWwiOiJVcGRhdGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sIjA5OTFiMWQyMjg2NGU3MmMwZTgzZWIwYTJjZDA3NzI3X2NvbHVtbnMiOlt7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoicHJvZHVjdF9jb2RlIiwibGFiZWwiOiJObyIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJpbWFnZV9zcmMiLCJsYWJlbCI6IlByZXZpZXciLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibmFtZSIsImxhYmVsIjoiTmFtYSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJlZGl0X2FjdGlvbiIsImxhYmVsIjoiIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImNhdGVnb3J5Lm5hbWUiLCJsYWJlbCI6IkthdGVnb3JpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImRpc3BsYXlfcHJpY2UiLCJsYWJlbCI6IkhhcmdhIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImlzX2FjdGl2ZSIsImxhYmVsIjoiQWt0aWYiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoiaXNfZmVhdHVyZWQiLCJsYWJlbCI6IlVuZ2d1bGFuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InNob3BlZV9jbGlja3MiLCJsYWJlbCI6IktsaWsgU2hvcGVlIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRpa3Rva19jbGlja3MiLCJsYWJlbCI6IktsaWsgVGlrVG9rIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InNvcnRfb3JkZXIiLCJsYWJlbCI6IlVydXRhbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjpmYWxzZSwiaXNUb2dnbGVhYmxlIjp0cnVlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOnRydWV9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJ1cGRhdGVkX2F0IiwibGFiZWwiOiJVcGRhdGUiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6ZmFsc2UsImlzVG9nZ2xlYWJsZSI6dHJ1ZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0Ijp0cnVlfV0sIjA5OTFiMWQyMjg2NGU3MmMwZTgzZWIwYTJjZDA3NzI3X3Blcl9wYWdlIjoiMjUifSwiZmlsYW1lbnQiOltdfQ==', 1780997600);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Etalasia Admin', 'admin@etalasia.test', '2026-05-24 08:36:54', '$2y$12$mBHQW4e/HRKRBUDF6h0eGuG6515qDcJ5THV9uFtTXuYBvF37ayoYe', 'IWmEXfDuJP', '2026-05-24 08:36:54', '2026-05-24 08:36:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_is_active_index` (`is_active`),
  ADD KEY `banners_sort_order_index` (`sort_order`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_is_active_index` (`is_active`),
  ADD KEY `categories_sort_order_index` (`sort_order`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_product_code_unique` (`product_code`),
  ADD KEY `products_category_id_is_active_index` (`category_id`,`is_active`),
  ADD KEY `products_price_index` (`price`),
  ADD KEY `products_is_active_index` (`is_active`),
  ADD KEY `products_is_featured_index` (`is_featured`),
  ADD KEY `products_sort_order_index` (`sort_order`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
