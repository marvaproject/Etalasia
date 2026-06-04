<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan — Etalasia</title>
    <meta name="robots" content="noindex">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-[#f7f4ee] text-[#20211d] antialiased">

    <header class="border-b border-[#ded6c7] bg-[#fffdf8]/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center px-4 py-4 sm:px-6">
            <a href="{{ route('catalog.home') }}" class="flex items-center gap-3" aria-label="Etalasia home">
                <span class="grid size-10 place-items-center rounded-full bg-[#1f8a70] text-lg font-black text-white">E</span>
                <span>
                    <span class="block text-xl font-black tracking-wide text-[#20211d]">Etalasia</span>
                    <span class="block text-xs font-semibold uppercase tracking-[0.18em] text-[#7c6f5c]">Affiliate Catalog</span>
                </span>
            </a>
        </div>
    </header>

    <main class="flex flex-1 items-center justify-center px-4 py-16 sm:px-6">
        <div class="text-center">
            {{-- Large decorative 404 --}}
            <div class="relative mx-auto mb-8 w-fit">
                <span class="select-none text-[10rem] font-black leading-none text-[#ded6c7] sm:text-[14rem]">404</span>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="grid size-20 place-items-center rounded-full bg-[#1f8a70] text-3xl font-black text-white shadow-lg">E</div>
                </div>
            </div>

            <h1 class="text-2xl font-black text-[#20211d] sm:text-3xl">Halaman tidak ditemukan</h1>
            <p class="mx-auto mt-3 max-w-md text-base leading-7 text-[#6e6355]">
                Produk, kategori, atau halaman yang kamu cari tidak ada atau mungkin sudah dihapus. Yuk balik ke katalog!
            </p>

            <div class="mt-8 flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
                <a
                    href="{{ route('catalog.home') }}"
                    class="rounded-full bg-[#1f8a70] px-6 py-3 text-sm font-black text-white transition hover:bg-[#176b57] active:scale-95"
                >
                    Lihat Katalog
                </a>
                <a
                    href="{{ route('catalog.home', ['marketplace' => 'shopee']) }}"
                    class="rounded-full border border-[#cfc4b4] px-6 py-3 text-sm font-bold text-[#6e6355] transition hover:border-[#f15a24] hover:text-[#f15a24] active:scale-95"
                >
                    Produk Shopee
                </a>
                <a
                    href="{{ route('catalog.home', ['marketplace' => 'tiktok']) }}"
                    class="rounded-full border border-[#cfc4b4] px-6 py-3 text-sm font-bold text-[#6e6355] transition hover:border-[#20211d] hover:text-[#20211d] active:scale-95"
                >
                    Produk TikTok
                </a>
            </div>
        </div>
    </main>

    <footer class="border-t border-[#ded6c7] bg-[#fffdf8] py-6 text-center">
        <p class="text-xs text-[#a89880]">&copy; {{ date('Y') }} Etalasia. Semua link merupakan link affiliate.</p>
    </footer>
</body>
</html>
