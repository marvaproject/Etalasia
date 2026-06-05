<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary Meta --}}
    <title>@yield('title', 'Etalasia — Katalog Affiliate Shopee & TikTok')</title>
    <meta name="description" content="@yield('description', 'Etalasia mengkurasi produk affiliate Shopee dan TikTok pilihan dalam katalog yang ringan dan mudah dibuka di mobile.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/Etalasia Logo Orange.svg') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Etalasia">
    <meta property="og:title" content="@yield('og_title', 'Etalasia — Katalog Affiliate Shopee & TikTok')">
    <meta property="og:description" content="@yield('og_description', 'Temukan pilihan produk dari Shopee dan TikTok dalam satu tempat.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.png'))">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Etalasia — Katalog Affiliate Shopee & TikTok')">
    <meta name="twitter:description" content="@yield('og_description', 'Temukan pilihan produk dari Shopee dan TikTok dalam satu tempat.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.png'))">

    {{-- Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body style="background:#F8F8F8; color:#0A0A0A;" class="antialiased">

    {{-- Header --}}}
    <header id="site-header" class="sticky top-0 z-40 border-b bg-white transition-shadow duration-200" style="border-color:#E4E4E7;">
        <div class="mx-auto flex max-w-6xl items-center gap-3 px-4 py-3 sm:px-6">

            {{-- Logo --}}
            <a href="{{ route('catalog.home') }}" class="flex shrink-0 items-center gap-2" aria-label="Etalasia home">
                <img src="{{ asset('images/Etalasia Logo.svg') }}" alt="Logo Etalasia" style="height: 32px; width: auto; max-height: 32px; object-fit: contain;">
                <span class="hidden text-[17px] font-extrabold tracking-tight text-[#0A0A0A] sm:block" style="font-family:'Plus Jakarta Sans',sans-serif;">Etalasia</span>
            </a>

            {{-- Search bar --}}
            <form
                id="header-search-form"
                method="GET"
                action="{{ isset($selectedCategory) && $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}"
                class="search-bar min-w-0 flex-1 max-w-[220px] min-[420px]:max-w-[260px] sm:max-w-md lg:max-w-lg"
            >
                <svg class="size-4 shrink-0" style="color:#737373;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                </svg>
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari produk…"
                    inputmode="search"
                    autocomplete="off"
                    class="w-full min-w-0 bg-transparent text-sm outline-none"
                    style="color:#0A0A0A;"
                >
                @foreach(['marketplace','sort','min_price','max_price'] as $param)
                    @if(request()->filled($param))
                        <input type="hidden" name="{{ $param }}" value="{{ request($param) }}">
                    @endif
                @endforeach
            </form>

            {{-- Wishlist / Saved Button --}}
            <a href="#"
               id="wishlist-header-btn"
               class="flex shrink-0 items-center gap-1.5 px-3 py-1.5 rounded-xl border transition-all duration-200 active:scale-95 text-xs font-semibold"
               style="border-color: #E4E4E7; color: #737373; min-height: 38px; -webkit-tap-highlight-color:transparent;"
               aria-label="Produk disimpan"
            >
                <x-tabler-heart class="size-4" stroke-width="2.2" />
                <span>Disimpan</span>
                <span id="wishlist-badge" class="hidden items-center justify-center rounded-full bg-[#FF6200] px-1.5 py-0.5 text-[9px] font-bold text-white leading-none">0</span>
            </a>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t bg-white py-6 mt-12 text-center" style="border-color:#E4E4E7;">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <p class="text-xs text-gray-400 leading-relaxed max-w-2xl mx-auto">
                Disclaimer: Etalasia adalah katalog kurasi produk affiliate. Kami mendapatkan komisi kecil dari setiap pembelian melalui tautan belanja di situs ini tanpa biaya tambahan untuk Anda.
            </p>
            <p class="text-[10px] text-gray-300 mt-2">
                &copy; {{ date('Y') }} Etalasia. All rights reserved.
            </p>
        </div>
    </footer>

    {{-- Back to Top --}}
    <button
        id="back-to-top"
        aria-label="Kembali ke atas"
        class="fixed bottom-6 right-6 z-50 hidden size-11 items-center justify-center rounded-full text-white"
        style="background:#FF6200; box-shadow: var(--shadow-2); transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.2s ease;"
        onmouseenter="this.style.transform='scale(1.1)'; this.style.boxShadow='var(--shadow-3)'"
        onmouseleave="this.style.transform='scale(1)'; this.style.boxShadow='var(--shadow-2)'"
        onmousedown="this.style.transform='scale(0.92)'; this.style.boxShadow='var(--shadow-1)'"
        onmouseup="this.style.transform='scale(1)'; this.style.boxShadow='var(--shadow-2)'"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    @stack('scripts')

    <script>
        /* ─── Header shadow on scroll ─────────────────────────────── */
        const header    = document.getElementById('site-header');
        const backToTop = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                header.classList.add('shadow-md');
                backToTop.classList.remove('hidden');
                backToTop.classList.add('flex');
            } else {
                header.classList.remove('shadow-md');
                backToTop.classList.add('hidden');
                backToTop.classList.remove('flex');
            }
        }, { passive: true });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
