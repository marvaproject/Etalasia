@extends('layouts.app')

@section('title', ($selectedCategory ? $selectedCategory->name . ' — ' : '') . 'Etalasia — Katalog Affiliate Shopee & TikTok')
@section('description', $selectedCategory
    ? 'Produk affiliate ' . $selectedCategory->name . ' pilihan dari Shopee dan TikTok.'
    : 'Etalasia mengkurasi produk affiliate Shopee dan TikTok pilihan dalam katalog yang ringan dan mudah dibuka di mobile.'
)

@section('content')

    {{-- ① Banner — Slider (flexible: kosong = hilang, 1 = static, 2+ = slider) --}}
    @if ($banners->isNotEmpty())
        <section style="background:#F8F8F8;">
            <div class="mx-auto max-w-6xl px-4 pt-3 sm:px-6">
                @if ($banners->count() === 1)
                    {{-- Single banner — static, no slider --}}
                    <a
                        href="{{ route('affiliate.banner', $banners->first()) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        id="banner-{{ $banners->first()->id }}"
                        class="mb-2 block overflow-hidden banner-slider img-skeleton"
                        style="box-shadow:var(--shadow-2); transition:transform 0.2s cubic-bezier(0.25,0.46,0.45,0.94),box-shadow 0.2s ease; -webkit-tap-highlight-color:transparent; border-radius:12px;"
                        onmouseenter="this.style.transform='scale(1.01)';this.style.boxShadow='var(--shadow-3)'"
                        onmouseleave="this.style.transform='scale(1)';this.style.boxShadow='var(--shadow-2)'"
                        onmousedown="this.style.transform='scale(0.98)'"
                        onmouseup="this.style.transform='scale(1.01)'"
                    >
                        <img
                            src="{{ $banners->first()->image_src }}"
                            alt="{{ $banners->first()->title }}"
                            class="img-banner"
                            loading="eager"
                            width="800" height="450"
                            onload="imgLoaded(this)" onerror="imgLoaded(this)"
                        >
                    </a>
                @else
                    {{-- Multiple banners — slider with dots --}}
                    <div class="banner-slider mb-2" id="bannerSlider" style="cursor:grab; box-shadow:var(--shadow-2); border-radius:12px;">
                        <div class="banner-track" id="bannerTrack">
                            @foreach ($banners as $banner)
                                <div class="banner-slide img-skeleton">
                                    <a
                                        href="{{ route('affiliate.banner', $banner) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        id="banner-{{ $banner->id }}"
                                        class="block"
                                        style="-webkit-tap-highlight-color:transparent;"
                                    >
                                        <img
                                            src="{{ $banner->image_src }}"
                                            alt="{{ $banner->title }}"
                                            class="img-banner"
                                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                            width="800" height="450"
                                            onload="imgLoaded(this)" onerror="imgLoaded(this)"
                                        >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Dot indicators --}}
                    <div class="banner-dots" id="bannerDots">
                        @foreach ($banners as $i => $banner)
                            <button
                                class="banner-dot {{ $i === 0 ? 'active' : '' }}"
                                data-index="{{ $i }}"
                                aria-label="Banner {{ $i + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ② Category Icon Chips --}}
    <div class="mx-auto max-w-6xl">
        <div class="cat-icon-row" role="navigation" aria-label="Kategori produk">

                {{-- Semua --}}
                <a href="{{ route('catalog.home') }}"
                   class="cat-icon-chip {{ !$selectedCategory ? 'active' : '' }}"
                   aria-label="Semua kategori">
                    <div class="cat-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                        </svg>
                    </div>
                    <span class="cat-icon-label">Semua</span>
                </a>

                @foreach ($categories as $category)
                    @php
                        $storedIcon = $category->icon; // e.g., 'heroicon-o-shopping-bag'
                        if (!$storedIcon) {
                            $n = strtolower($category->name);
                            $iconKey = match(true) {
                                str_contains($n,'fashion')||str_contains($n,'baju')||str_contains($n,'pakaian')||str_contains($n,'kaos')||str_contains($n,'celana')||str_contains($n,'jaket')||str_contains($n,'dress')||str_contains($n,'sepatu')||str_contains($n,'tas')||str_contains($n,'clothing')||str_contains($n,'clothes')||str_contains($n,'shirt')||str_contains($n,'blouse')||str_contains($n,'skirt')||str_contains($n,'rok')||str_contains($n,'kemeja')||str_contains($n,'sweater')||str_contains($n,'hoodie')||str_contains($n,'apparel') => 'shopbag',
                                str_contains($n,'elektronik')||str_contains($n,'gadget')||str_contains($n,' hp')||str_contains($n,'laptop')||str_contains($n,'komputer')||str_contains($n,'phone')||str_contains($n,'tech')||str_contains($n,'audio')||str_contains($n,'kamera') => 'phone',
                                str_contains($n,'kecantikan')||str_contains($n,'beauty')||str_contains($n,'skincare')||str_contains($n,'kosmetik')||str_contains($n,'perawatan')||str_contains($n,'makeup')||str_contains($n,'parfum') => 'sparkles',
                                str_contains($n,'rumah')||str_contains($n,'home')||str_contains($n,'furniture')||str_contains($n,'dapur')||str_contains($n,'interior')||str_contains($n,'dekorasi')||str_contains($n,'household')||str_contains($n,'perabot') => 'home',
                                str_contains($n,'makanan')||str_contains($n,'kuliner')||str_contains($n,'minuman')||str_contains($n,'food')||str_contains($n,'snack')||str_contains($n,'kopi')||str_contains($n,'beverage')||str_contains($n,'jajanan') => 'fire',
                                str_contains($n,'olahraga')||str_contains($n,'sport')||str_contains($n,'fitness')||str_contains($n,'gym')||str_contains($n,'outdoor')||str_contains($n,'hiking') => 'bolt',
                                str_contains($n,'aksesoris')||str_contains($n,'perhiasan')||str_contains($n,'jewelry')||str_contains($n,'jam')||str_contains($n,'watch')||str_contains($n,'cincin')||str_contains($n,'gelang') => 'star',
                                str_contains($n,'anak')||str_contains($n,'bayi')||str_contains($n,'kids')||str_contains($n,'mainan')||str_contains($n,'baby')||str_contains($n,'toys') => 'heart',
                                str_contains($n,'buku')||str_contains($n,'alat tulis')||str_contains($n,'stationery')||str_contains($n,'pendidikan')||str_contains($n,'education')||str_contains($n,'kantor') => 'book',
                                str_contains($n,'otomotif')||str_contains($n,'motor')||str_contains($n,'mobil')||str_contains($n,'automotive')||str_contains($n,'spare')||str_contains($n,'kendaraan') => 'truck',
                                default => 'tag'
                            };
                        }
                    @endphp
                    <a href="{{ route('catalog.category', $category) }}"
                       class="cat-icon-chip {{ $selectedCategory?->is($category) ? 'active' : '' }}"
                       aria-label="Kategori {{ $category->name }}">
                        <div class="cat-icon-box">
                            @if($storedIcon)
                                {{-- Gunakan ikon yang dipilih admin dari icon picker --}}
                                <x-dynamic-component :component="$storedIcon" class="size-[22px]" />
                            @elseif ($iconKey === 'shopbag')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            @elseif ($iconKey === 'phone')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3"/>
                                </svg>
                            @elseif ($iconKey === 'sparkles')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
                                </svg>
                            @elseif ($iconKey === 'home')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                </svg>
                            @elseif ($iconKey === 'fire')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/>
                                </svg>
                            @elseif ($iconKey === 'bolt')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                </svg>
                            @elseif ($iconKey === 'star')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                </svg>
                            @elseif ($iconKey === 'heart')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                                </svg>
                            @elseif ($iconKey === 'book')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                            @elseif ($iconKey === 'truck')
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                                </svg>
                            @else
                                {{-- Default: Tag icon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-[22px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/>
                                </svg>
                            @endif
                        </div>
                        <span class="cat-icon-label">{{ $category->name }}</span>
                    </a>
                @endforeach

        </div>
    </div>


    {{-- ③ Filter + Grid --}}
    <section id="products" class="mx-auto max-w-6xl px-4 py-3 sm:px-6">

        @php
            $activeFilters = collect(['marketplace','min_price','max_price','sort','category'])
                ->filter(fn($k) => request()->filled($k))
                ->count();
            $sortLabel = match(request('sort')) {
                'newest'     => 'Terbaru',
                'price_asc'  => 'Termurah',
                'price_desc' => 'Termahal',
                default      => 'Unggulan',
            };
            $marketplaceLabel = match(request('marketplace')) {
                'shopee' => 'Shopee',
                'tiktok' => 'TikTok',
                'both'   => 'Keduanya',
                default  => 'Semua',
            };
        @endphp

        <form
            method="GET"
            action="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}"
            id="filter-form"
        >
            {{-- Mobile: bar ringkas dengan custom dropdown --}}
            <div class="flex items-center gap-2 lg:hidden">

                {{-- Custom Sort Dropdown --}}
                <div class="custom-select flex-1" id="sortSelect">
                    <button type="button" class="custom-select-trigger" onclick="toggleDropdown('sortSelect')">
                        <span id="sortLabel">{{ $sortLabel }}</span>
                        <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="custom-select-dropdown" id="sortSelectDropdown">
                        <div class="custom-select-option {{ !request('sort') ? 'selected' : '' }}" onclick="selectOption('sortSelect', '', 'Unggulan', 'sort')">Unggulan</div>
                        <div class="custom-select-option {{ request('sort') === 'newest' ? 'selected' : '' }}" onclick="selectOption('sortSelect', 'newest', 'Terbaru', 'sort')">Terbaru</div>
                        <div class="custom-select-option {{ request('sort') === 'price_asc' ? 'selected' : '' }}" onclick="selectOption('sortSelect', 'price_asc', 'Termurah', 'sort')">Termurah</div>
                        <div class="custom-select-option {{ request('sort') === 'price_desc' ? 'selected' : '' }}" onclick="selectOption('sortSelect', 'price_desc', 'Termahal', 'sort')">Termahal</div>
                    </div>
                    <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                </div>

                {{-- Custom Marketplace Dropdown --}}
                <div class="custom-select flex-1" id="mktSelect">
                    <button type="button" class="custom-select-trigger" onclick="toggleDropdown('mktSelect')">
                        <span id="mktLabel">{{ $marketplaceLabel }}</span>
                        <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="custom-select-dropdown" id="mktSelectDropdown">
                        <div class="custom-select-option {{ !request('marketplace') ? 'selected' : '' }}" onclick="selectOption('mktSelect', '', 'Semua', 'marketplace')">Semua</div>
                        <div class="custom-select-option {{ request('marketplace') === 'shopee' ? 'selected' : '' }}" onclick="selectOption('mktSelect', 'shopee', 'Shopee', 'marketplace')">Shopee</div>
                        <div class="custom-select-option {{ request('marketplace') === 'tiktok' ? 'selected' : '' }}" onclick="selectOption('mktSelect', 'tiktok', 'TikTok', 'marketplace')">TikTok</div>
                        <div class="custom-select-option {{ request('marketplace') === 'both' ? 'selected' : '' }}" onclick="selectOption('mktSelect', 'both', 'Keduanya', 'marketplace')">Keduanya</div>
                    </div>
                    <input type="hidden" name="marketplace" id="mktInput" value="{{ request('marketplace') }}">
                </div>

                {{-- Filter toggle --}}
                <button
                    type="button"
                    id="filter-toggle"
                    class="filter-toggle-btn relative flex items-center gap-1.5 border bg-white px-3 py-2 text-xs font-semibold"
                    style="border-color:#E4E4E7; border-radius:10px; color:#0A0A0A; min-height:38px;"
                >
                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 12h10M11 20h2"/>
                    </svg>
                    Filter
                    @if($activeFilters > 0)
                        <span class="absolute -right-1.5 -top-1.5 flex size-4 items-center justify-center rounded-full text-[9px] font-black text-white" style="background:#FF6200;">{{ $activeFilters }}</span>
                    @endif
                </button>
            </div>

            {{-- Mobile: panel filter tambahan --}}
            <div id="filter-panel" class="mt-2 hidden rounded-xl border bg-white p-3 lg:hidden" style="border-color:#E4E4E7; box-shadow:var(--shadow-2);">
                <div class="grid grid-cols-2 gap-2">
                    @unless ($selectedCategory)
                        <label class="col-span-2">
                            <span class="mb-1 block text-[10px] font-bold uppercase tracking-[0.14em]" style="color:#737373;">Kategori</span>
                            <div class="custom-select" id="catSelect">
                                <button type="button" class="custom-select-trigger" onclick="toggleDropdown('catSelect')">
                                    <span id="catLabel">{{ request('category') ? $categories->firstWhere('slug', request('category'))?->name ?? 'Semua' : 'Semua' }}</span>
                                    <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="custom-select-dropdown" id="catSelectDropdown">
                                    <div class="custom-select-option {{ !request('category') ? 'selected' : '' }}" onclick="selectOption('catSelect', '', 'Semua', 'category')">Semua</div>
                                    @foreach ($categories as $cat)
                                        <div class="custom-select-option {{ request('category') === $cat->slug ? 'selected' : '' }}" onclick="selectOption('catSelect', '{{ $cat->slug }}', '{{ $cat->name }}', 'category')">{{ $cat->name }}</div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="category" id="catInput" value="{{ request('category') }}">
                            </div>
                        </label>
                    @endunless
                    <label>
                        <span class="mb-1 block text-[10px] font-bold uppercase tracking-[0.14em]" style="color:#737373;">Harga Min</span>
                        <input name="min_price" value="{{ request('min_price') }}" type="number" min="0" placeholder="0"
                            class="w-full border bg-white px-3 py-2 text-xs outline-none"
                            style="border-color:#E4E4E7; border-radius:10px; color:#0A0A0A; min-height:38px;">
                    </label>
                    <label>
                        <span class="mb-1 block text-[10px] font-bold uppercase tracking-[0.14em]" style="color:#737373;">Harga Max</span>
                        <input name="max_price" value="{{ request('max_price') }}" type="number" min="0" placeholder="999000"
                            class="w-full border bg-white px-3 py-2 text-xs outline-none"
                            style="border-color:#E4E4E7; border-radius:10px; color:#0A0A0A; min-height:38px;">
                    </label>
                </div>
                <div class="mt-2 flex gap-2">
                    <button type="submit" class="flex-1 py-2 text-xs font-bold text-white" style="background:#FF6200; border-radius:10px;">Terapkan</button>
                    <a href="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}" class="border px-4 py-2 text-xs font-semibold" style="border-color:#E4E4E7; border-radius:10px; color:#737373;">Reset</a>
                </div>
            </div>

            {{-- Desktop: filter lengkap dengan custom dropdown --}}
            <div class="mt-3 hidden rounded-xl border bg-white p-4 lg:grid lg:grid-cols-5 lg:gap-3" style="border-color:#E4E4E7; box-shadow:var(--shadow-1);">
                @if(request()->filled('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif

                @unless ($selectedCategory)
                    <label>
                        <span class="mb-1 block text-xs font-bold uppercase tracking-[0.14em]" style="color:#737373;">Kategori</span>
                        <div class="custom-select" id="catSelectDesktop">
                            <button type="button" class="custom-select-trigger" onclick="toggleDropdown('catSelectDesktop')">
                                <span id="catLabelDesktop">{{ request('category') ? $categories->firstWhere('slug', request('category'))?->name ?? 'Semua' : 'Semua' }}</span>
                                <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="custom-select-dropdown" id="catSelectDesktopDropdown">
                                <div class="custom-select-option {{ !request('category') ? 'selected' : '' }}" onclick="selectOption('catSelectDesktop', '', 'Semua', 'category')">Semua</div>
                                @foreach ($categories as $cat)
                                    <div class="custom-select-option {{ request('category') === $cat->slug ? 'selected' : '' }}" onclick="selectOption('catSelectDesktop', '{{ $cat->slug }}', '{{ $cat->name }}', 'category')">{{ $cat->name }}</div>
                                @endforeach
                            </div>
                            <input type="hidden" name="category" id="catInputDesktop" value="{{ request('category') }}">
                        </div>
                    </label>
                @endunless

                <label>
                    <span class="mb-1 block text-xs font-bold uppercase tracking-[0.14em]" style="color:#737373;">Marketplace</span>
                    <div class="custom-select" id="mktSelectDesktop">
                        <button type="button" class="custom-select-trigger" onclick="toggleDropdown('mktSelectDesktop')">
                            <span id="mktLabelDesktop">{{ $marketplaceLabel }}</span>
                            <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="custom-select-dropdown" id="mktSelectDesktopDropdown">
                            <div class="custom-select-option {{ !request('marketplace') ? 'selected' : '' }}" onclick="selectOption('mktSelectDesktop', '', 'Semua', 'marketplace')">Semua</div>
                            <div class="custom-select-option {{ request('marketplace') === 'shopee' ? 'selected' : '' }}" onclick="selectOption('mktSelectDesktop', 'shopee', 'Shopee', 'marketplace')">Shopee</div>
                            <div class="custom-select-option {{ request('marketplace') === 'tiktok' ? 'selected' : '' }}" onclick="selectOption('mktSelectDesktop', 'tiktok', 'TikTok', 'marketplace')">TikTok</div>
                            <div class="custom-select-option {{ request('marketplace') === 'both' ? 'selected' : '' }}" onclick="selectOption('mktSelectDesktop', 'both', 'Shopee + TikTok', 'marketplace')">Shopee + TikTok</div>
                        </div>
                        <input type="hidden" name="marketplace" id="mktInputDesktop" value="{{ request('marketplace') }}">
                    </div>
                </label>

                <label>
                    <span class="mb-1 block text-xs font-bold uppercase tracking-[0.14em]" style="color:#737373;">Harga Min</span>
                    <input name="min_price" value="{{ request('min_price') }}" type="number" min="0" placeholder="0"
                        class="w-full border bg-white px-4 py-2 text-sm outline-none"
                        style="border-color:#E4E4E7; border-radius:10px; color:#0A0A0A; min-height:38px;">
                </label>

                <label>
                    <span class="mb-1 block text-xs font-bold uppercase tracking-[0.14em]" style="color:#737373;">Harga Max</span>
                    <input name="max_price" value="{{ request('max_price') }}" type="number" min="0" placeholder="999000"
                        class="w-full border bg-white px-4 py-2 text-sm outline-none"
                        style="border-color:#E4E4E7; border-radius:10px; color:#0A0A0A; min-height:38px;">
                </label>

                <label>
                    <span class="mb-1 block text-xs font-bold uppercase tracking-[0.14em]" style="color:#737373;">Sort</span>
                    <div class="custom-select" id="sortSelectDesktop">
                        <button type="button" class="custom-select-trigger" onclick="toggleDropdown('sortSelectDesktop')">
                            <span id="sortLabelDesktop">{{ $sortLabel }}</span>
                            <svg class="chevron size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="custom-select-dropdown" id="sortSelectDesktopDropdown">
                            <div class="custom-select-option {{ !request('sort') ? 'selected' : '' }}" onclick="selectOption('sortSelectDesktop', '', 'Unggulan', 'sort')">Unggulan</div>
                            <div class="custom-select-option {{ request('sort') === 'newest' ? 'selected' : '' }}" onclick="selectOption('sortSelectDesktop', 'newest', 'Terbaru', 'sort')">Terbaru</div>
                            <div class="custom-select-option {{ request('sort') === 'price_asc' ? 'selected' : '' }}" onclick="selectOption('sortSelectDesktop', 'price_asc', 'Termurah', 'sort')">Termurah</div>
                            <div class="custom-select-option {{ request('sort') === 'price_desc' ? 'selected' : '' }}" onclick="selectOption('sortSelectDesktop', 'price_desc', 'Termahal', 'sort')">Termahal</div>
                        </div>
                        <input type="hidden" name="sort" id="sortInputDesktop" value="{{ request('sort') }}">
                    </div>
                </label>

                <div class="flex items-end gap-2 lg:col-span-5">
                    <button type="submit" class="px-5 py-2 text-sm font-bold text-white" style="background:#FF6200; border-radius:10px; min-height:38px;">Terapkan Filter</button>
                    <a href="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}" class="border px-5 py-2 text-sm font-semibold" style="border-color:#E4E4E7; border-radius:10px; color:#737373; min-height:38px; display:inline-flex; align-items:center;">Reset</a>
                    @if ($activeFilters > 0)
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold" style="background:#FFF3EC; color:#FF6200;">{{ $activeFilters }} filter aktif</span>
                    @endif
                </div>
            </div>
        </form>

        {{-- Section header --}}
        <div class="mb-3 mt-4 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold" style="color:#0A0A0A;">{{ $selectedCategory?->name ?? 'Semua Produk' }}</h2>
                <p class="text-xs" style="color:#737373;">{{ $products->total() }} produk</p>
            </div>
        </div>

        {{-- ④ Product Grid --}}
        <div class="grid grid-cols-2 gap-[10px] sm:gap-[14px] lg:grid-cols-4">
            @forelse ($products as $product)

                <article class="product-card">

                    {{-- Gambar 1:1 — skeleton shimmer --}}
                    <div class="img-skeleton relative aspect-square overflow-hidden" style="border-radius:12px 12px 0 0;">
                        <img
                            src="{{ $product->image_src }}"
                            alt="{{ $product->name }}"
                            class="img-real"
                            loading="lazy"
                            width="300" height="300"
                            onload="imgLoaded(this)"
                            onerror="imgLoaded(this)"
                        >
                        {{-- Badge kategori --}}
                        <span class="absolute right-2 top-2 max-w-[calc(100%-1rem)] truncate rounded-full px-2 py-0.5 text-[10px] font-semibold" style="background:rgba(255,255,255,0.92); color:#FF6200; backdrop-filter:blur(4px);">
                            {{ $product->category->name }}
                        </span>
                        {{-- Badge unggulan --}}
                        @if ($product->is_featured)
                            <span class="absolute left-2 top-2 rounded-full px-2 py-0.5 text-[9px] font-black uppercase tracking-wide" style="background:#FF6200; color:#fff;">
                                Unggulan
                            </span>
                        @endif
                    </div>

                    {{-- Info produk --}}
                    <div class="flex flex-1 flex-col p-[10px] sm:p-3">

                        {{-- Nama --}}
                        <h3 class="line-clamp-2 text-[12px] font-semibold leading-snug sm:text-[13px]" style="color:#0A0A0A;">
                            {{ $product->name }}
                        </h3>

                        {{-- Harga --}}
                        @if ($product->display_price)
                            <p class="mt-1 text-[14px] font-bold tracking-tight sm:text-[15px]" style="color:#FF6200;">
                                {{ $product->display_price }}
                            </p>
                        @endif

                        {{-- Marketplace badge + nomor produk (1 baris) --}}
                        <div class="mt-1 flex items-center gap-1 flex-wrap">
                            @if ($product->shopee_url)
                                <span class="rounded-full px-1.5 py-0.5 text-[9px] font-semibold" style="background:#FFF0EB; color:#EE4D2D;">Shopee</span>
                            @endif
                            @if ($product->tiktok_url)
                                <span class="rounded-full px-1.5 py-0.5 text-[9px] font-semibold" style="background:#EEEEEE; color:#0A0A0A;">TikTok</span>
                            @endif
                            @if ($product->product_code)
                                <span class="product-code-badge" style="margin-left:auto;">{{ $product->formatted_code }}</span>
                            @endif
                        </div>

                        {{-- Tombol affiliate — auto-layout 1 atau 2 kolom --}}
                        @if ($product->shopee_url && $product->tiktok_url)
                            <div class="mt-auto grid grid-cols-2 gap-1.5 pt-2">
                        @else
                            <div class="mt-auto grid grid-cols-1 pt-2">
                        @endif
                            @if ($product->shopee_url)
                                <a
                                    href="{{ route('affiliate.product', [$product, 'shopee']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    id="btn-shopee-{{ $product->id }}"
                                    class="btn-shopee"
                                >
                                    Shopee
                                </a>
                            @endif
                            @if ($product->tiktok_url)
                                <a
                                    href="{{ route('affiliate.product', [$product, 'tiktok']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    id="btn-tiktok-{{ $product->id }}"
                                    class="btn-tiktok"
                                >
                                    Tiktok Shop
                                </a>
                            @endif
                        </div>
                    </div>
                </article>

            @empty
                <div class="col-span-2 rounded-xl border border-dashed p-10 text-center lg:col-span-4" style="border-color:#E4E4E7; background:#F8F8F8;">
                    <div class="mx-auto mb-3 grid size-14 place-items-center rounded-full" style="background:#EEEEEE;">
                        <svg class="size-7" style="color:#737373;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 15.803M10.5 7.5v6m3-3h-6"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold" style="color:#0A0A0A;">Produk tidak ditemukan</h3>
                    <p class="mt-1 text-xs" style="color:#737373;">Coba reset filter atau ketik nomor produk (contoh: #42)</p>
                    <a href="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}"
                        class="mt-3 inline-block rounded-full border px-4 py-1.5 text-xs font-semibold"
                        style="border-color:#E4E4E7; color:#737373;">
                        Reset Filter
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-6 pb-8">
            {{ $products->links() }}
        </div>
    </section>

@endsection

@push('scripts')
<script>
/* ─── Custom Dropdown Logic ─────────────────────────────── */
function toggleDropdown(id) {
    const container  = document.getElementById(id);
    const trigger    = container.querySelector('.custom-select-trigger');
    const dropdown   = container.querySelector('.custom-select-dropdown');
    const isOpen     = dropdown.classList.contains('open');

    // Close all other dropdowns first
    document.querySelectorAll('.custom-select-dropdown.open').forEach(d => {
        d.classList.remove('open');
        d.closest('.custom-select').querySelector('.custom-select-trigger').classList.remove('open');
    });

    if (!isOpen) {
        dropdown.classList.add('open');
        trigger.classList.add('open');
        // Re-trigger animation
        dropdown.style.animation = 'none';
        requestAnimationFrame(() => {
            dropdown.style.animation = '';
        });
    }
}

function selectOption(containerId, value, label, inputName) {
    const container = document.getElementById(containerId);
    const trigger   = container.querySelector('.custom-select-trigger');
    const dropdown  = container.querySelector('.custom-select-dropdown');
    const input     = container.querySelector('input[type=hidden]');
    const labelEl   = trigger.querySelector('span');

    // Update label and value
    labelEl.textContent = label;
    input.value = value;

    // Mark selected
    container.querySelectorAll('.custom-select-option').forEach(opt => {
        opt.classList.toggle('selected', opt.dataset.val === value || opt.textContent.trim() === label);
    });

    // Close dropdown
    dropdown.classList.remove('open');
    trigger.classList.remove('open');

    // Auto-submit (mirrors the old onchange behaviour)
    document.getElementById('filter-form').submit();
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.custom-select')) {
        document.querySelectorAll('.custom-select-dropdown.open').forEach(d => {
            d.classList.remove('open');
            d.closest('.custom-select').querySelector('.custom-select-trigger').classList.remove('open');
        });
    }
});

/* ─── Image Skeleton: fade in on load ──────────────────── */
function imgLoaded(img) {
    img.classList.add('loaded');
    // For product card images: also mark the skeleton wrapper as done
    const skeleton = img.closest('.img-skeleton');
    if (skeleton) skeleton.classList.add('loaded');
}

/* ─── Optimistic dim: grid fades when navigating ────────── */
function dimGrid() {
    const grid = document.querySelector('#products > .grid');
    if (grid) grid.classList.add('grid-dimmed');
}

// Dim on filter form submit
const filterForm = document.getElementById('filter-form');
if (filterForm) filterForm.addEventListener('submit', dimGrid);

// Dim on category tab click
document.querySelectorAll('.cat-pill').forEach(pill => {
    pill.addEventListener('click', dimGrid);
});

// Dim on pagination click
document.querySelectorAll('[rel="next"], [rel="prev"], .pagination a').forEach(a => {
    a.addEventListener('click', dimGrid);
});

/* ─── Filter Panel Toggle ───────────────────────────────── */
const filterToggle = document.getElementById('filter-toggle');
const filterPanel  = document.getElementById('filter-panel');
if (filterToggle && filterPanel) {
    filterToggle.addEventListener('click', () => {
        const isHidden = filterPanel.classList.contains('hidden');
        filterPanel.classList.toggle('hidden');
        if (isHidden) {
            filterPanel.style.opacity = '0';
            filterPanel.style.transform = 'translateY(-6px)';
            requestAnimationFrame(() => {
                filterPanel.style.transition = 'opacity 0.2s ease, transform 0.25s cubic-bezier(0.34,1.56,0.64,1)';
                filterPanel.style.opacity = '1';
                filterPanel.style.transform = 'translateY(0)';
            });
        }
    });
}

/* ─── Banner Slider ─────────────────────────────────────── */
const sliderEl = document.getElementById('bannerSlider');
if (sliderEl) {
    const track  = document.getElementById('bannerTrack');
    const dots   = document.querySelectorAll('.banner-dot');
    const total  = dots.length;
    let current  = 0;
    let autoplay, isDragging = false, startX = 0, diffX = 0;

    function goTo(index) {
        current = (index + total) % total;
        track.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    function startAuto() {
        autoplay = setInterval(() => goTo(current + 1), 4500);
    }
    function stopAuto() { clearInterval(autoplay); }

    dots.forEach(dot => dot.addEventListener('click', () => {
        stopAuto(); goTo(+dot.dataset.index); startAuto();
    }));

    // Touch/mouse swipe
    sliderEl.addEventListener('mousedown',  e => { isDragging = true; startX = e.clientX; stopAuto(); sliderEl.style.cursor = 'grabbing'; });
    sliderEl.addEventListener('touchstart', e => { isDragging = true; startX = e.touches[0].clientX; stopAuto(); }, { passive: true });

    sliderEl.addEventListener('mousemove',  e => { if (isDragging) diffX = e.clientX - startX; });
    sliderEl.addEventListener('touchmove',  e => { if (isDragging) diffX = e.touches[0].clientX - startX; }, { passive: true });

    const endSwipe = () => {
        if (!isDragging) return;
        isDragging = false; sliderEl.style.cursor = 'grab';
        if (Math.abs(diffX) > 50) goTo(diffX < 0 ? current + 1 : current - 1);
        diffX = 0; startAuto();
    };
    sliderEl.addEventListener('mouseup',    endSwipe);
    sliderEl.addEventListener('mouseleave', endSwipe);
    sliderEl.addEventListener('touchend',   endSwipe);

    // Pause on hover (desktop)
    sliderEl.addEventListener('mouseenter', stopAuto);
    sliderEl.addEventListener('mouseleave', startAuto);

    startAuto();
}
</script>
@endpush
