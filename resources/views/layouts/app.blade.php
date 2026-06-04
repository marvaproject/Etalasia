<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Primary Meta --}}
    <title>@yield('title', 'Etalasia — Katalog Affiliate Shopee & TikTok')</title>
    <meta name="description" content="@yield('description', 'Etalasia mengkurasi produk affiliate Shopee dan TikTok pilihan dalam katalog yang ringan dan mudah dibuka di mobile.')">
    <link rel="canonical" href="{{ url()->current() }}">

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

    {{-- NProgress Loading Bar --}}
    <div id="nprogress" aria-hidden="true"><div class="bar"><div class="peg"></div></div></div>

    {{-- Header --}}
    <header id="site-header" class="sticky top-0 z-40 border-b bg-white transition-shadow duration-200" style="border-color:#E4E4E7;">
        <div class="mx-auto flex max-w-6xl items-center gap-3 px-4 py-3 sm:px-6">

            {{-- Logo --}}
            <a href="{{ route('catalog.home') }}" class="flex shrink-0 items-center gap-2" aria-label="Etalasia home">
                <span class="grid size-8 place-items-center rounded-full text-sm font-extrabold text-white" style="background:#FF6200;">E</span>
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
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

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
        /* ─── NProgress: Loading Bar ──────────────────────────────── */
        const _np = {
            el:  document.getElementById('nprogress'),
            bar: document.querySelector('#nprogress .bar'),
            _t1: null, _t2: null,
            start() {
                clearTimeout(this._t1); clearTimeout(this._t2);
                this.bar.style.transition = 'none';
                this.bar.style.transform  = 'scaleX(0)';
                this.el.classList.add('active');
                requestAnimationFrame(() => {
                    this.bar.style.transition = 'transform 0.4s cubic-bezier(0.25,0.46,0.45,0.94)';
                    this.bar.style.transform  = 'scaleX(0.65)';
                    this._t1 = setTimeout(() => {
                        this.bar.style.transition = 'transform 2.5s ease';
                        this.bar.style.transform  = 'scaleX(0.9)';
                    }, 500);
                });
            },
            done() {
                clearTimeout(this._t1); clearTimeout(this._t2);
                this.bar.style.transition = 'transform 0.15s ease';
                this.bar.style.transform  = 'scaleX(1)';
                this._t2 = setTimeout(() => {
                    this.el.classList.remove('active');
                    setTimeout(() => {
                        this.bar.style.transition = 'none';
                        this.bar.style.transform  = 'scaleX(0)';
                    }, 220);
                }, 160);
            }
        };

        // Trigger on any navigation
        document.addEventListener('click', e => {
            const link = e.target.closest('a[href]');
            if (!link) return;
            const href = link.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('javascript') ||
                link.target === '_blank' || link.rel?.includes('noopener')) return;
            _np.start();
        });
        document.addEventListener('submit', e => {
            if (e.target.tagName === 'FORM' && (!e.target.target || e.target.target !== '_blank')) {
                _np.start();
            }
        });
        window.addEventListener('pageshow', () => _np.done());

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
