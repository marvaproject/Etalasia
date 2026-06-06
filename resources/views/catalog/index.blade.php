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
                            width="1000" height="300"
                            onload="imgLoaded(this)" onerror="imgError(this)"
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
                                            width="1000" height="300"
                                            onload="imgLoaded(this)" onerror="imgError(this)"
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
                        $storedIcon = $category->icon; // e.g., 'tabler-shirt'
                        if (!$storedIcon) {
                            $n = strtolower($category->name);
                            $iconKey = match(true) {
                                str_contains($n,'fashion')||str_contains($n,'baju')||str_contains($n,'pakaian')||str_contains($n,'kaos')||str_contains($n,'celana')||str_contains($n,'jaket')||str_contains($n,'dress')||str_contains($n,'sepatu')||str_contains($n,'tas')||str_contains($n,'clothing')||str_contains($n,'clothes')||str_contains($n,'shirt')||str_contains($n,'blouse')||str_contains($n,'skirt')||str_contains($n,'rok')||str_contains($n,'kemeja')||str_contains($n,'sweater')||str_contains($n,'hoodie')||str_contains($n,'apparel') => 'tabler-shirt',
                                str_contains($n,'elektronik')||str_contains($n,'gadget')||str_contains($n,' hp')||str_contains($n,'laptop')||str_contains($n,'komputer')||str_contains($n,'phone')||str_contains($n,'tech')||str_contains($n,'audio')||str_contains($n,'kamera') => 'tabler-device-mobile',
                                str_contains($n,'kecantikan')||str_contains($n,'beauty')||str_contains($n,'skincare')||str_contains($n,'kosmetik')||str_contains($n,'perawatan')||str_contains($n,'makeup')||str_contains($n,'parfum') => 'tabler-sparkles',
                                str_contains($n,'rumah')||str_contains($n,'home')||str_contains($n,'furniture')||str_contains($n,'dapur')||str_contains($n,'interior')||str_contains($n,'dekorasi')||str_contains($n,'household')||str_contains($n,'perabot') => 'tabler-home',
                                str_contains($n,'makanan')||str_contains($n,'kuliner')||str_contains($n,'minuman')||str_contains($n,'food')||str_contains($n,'snack')||str_contains($n,'kopi')||str_contains($n,'beverage')||str_contains($n,'jajanan') => 'tabler-utensils',
                                str_contains($n,'olahraga')||str_contains($n,'sport')||str_contains($n,'fitness')||str_contains($n,'gym')||str_contains($n,'outdoor')||str_contains($n,'hiking') => 'tabler-barbell',
                                str_contains($n,'aksesoris')||str_contains($n,'perhiasan')||str_contains($n,'jewelry')||str_contains($n,'jam')||str_contains($n,'watch')||str_contains($n,'cincin')||str_contains($n,'gelang') => 'tabler-gem',
                                str_contains($n,'anak')||str_contains($n,'bayi')||str_contains($n,'kids')||str_contains($n,'mainan')||str_contains($n,'baby')||str_contains($n,'toys') => 'tabler-pacifier',
                                str_contains($n,'buku')||str_contains($n,'alat tulis')||str_contains($n,'stationery')||str_contains($n,'pendidikan')||str_contains($n,'education')||str_contains($n,'kantor') => 'tabler-book',
                                str_contains($n,'otomotif')||str_contains($n,'motor')||str_contains($n,'mobil')||str_contains($n,'automotive')||str_contains($n,'spare')||str_contains($n,'kendaraan') => 'tabler-car',
                                default => 'tabler-tag'
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
                            @else
                                {{-- Fallback ke ikon Tabler default berdasarkan nama kategori --}}
                                <x-dynamic-component :component="$iconKey" class="size-[22px]" />
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
                            onerror="imgError(this)"
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

                        {{-- Tombol Bagikan --}}
                        <button
                            type="button"
                            onclick="shareProduct(event, '{{ addslashes($product->name) }}', '{{ route('catalog.home', ['q' => $product->formatted_code]) }}')"
                            class="absolute z-10 flex size-8 items-center justify-center rounded-full bg-white/90 shadow-sm transition-transform active:scale-90"
                            style="right: 48px; bottom: 8px; backdrop-filter:blur(4px); color:#737373; border: 1px solid rgba(0,0,0,0.06); -webkit-tap-highlight-color:transparent;"
                            aria-label="Bagikan produk"
                        >
                            <x-tabler-share class="size-4" stroke-width="2.5" />
                        </button>

                        {{-- Tombol Simpan (Heart) --}}
                        <button
                            type="button"
                            onclick="toggleFavorite(event, {{ $product->id }})"
                            class="absolute z-10 flex size-8 items-center justify-center rounded-full bg-white/90 shadow-sm transition-transform active:scale-90"
                            style="right: 8px; bottom: 8px; backdrop-filter:blur(4px); color:#737373; border: 1px solid rgba(0,0,0,0.06); -webkit-tap-highlight-color:transparent;"
                            id="fav-btn-{{ $product->id }}"
                            aria-label="Simpan ke favorit"
                        >
                            <x-tabler-heart class="size-4 fav-icon" stroke-width="2.5" />
                        </button>
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

    // Auto-submit via dispatching submit event to support AJAX loading
    const form = document.getElementById('filter-form');
    if (form) {
        if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
        } else {
            form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
        }
    }
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

function imgError(img) {
    let retries = parseInt(img.getAttribute('data-retries') || '0');
    if (retries < 3) {
        retries++;
        img.setAttribute('data-retries', retries);
        setTimeout(() => {
            const originalSrc = img.src;
            img.src = ''; // Clear to trigger reload
            
            // Add or update cache-buster query param as retry count
            try {
                const url = new URL(originalSrc);
                url.searchParams.set('retry', retries);
                img.src = url.toString();
            } catch(e) {
                // Fallback for relative paths
                if (originalSrc.includes('?')) {
                    img.src = originalSrc.split('?')[0] + '?retry=' + retries;
                } else {
                    img.src = originalSrc + '?retry=' + retries;
                }
            }
        }, retries * 1500); // 1.5s, 3s, 4.5s backoff
    } else {
        // Stop retrying, load SVG placeholder
        img.onerror = null;
        if (img.classList.contains('img-banner')) {
            img.src = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='1000' height='300' viewBox='0 0 1000 300'><rect width='100%' height='100%' fill='%23f3f4f6'/><text x='50%' y='50%' font-family='sans-serif' font-size='20' fill='%239ca3af' dominant-baseline='middle' text-anchor='middle'>Gambar tidak dapat dimuat</text></svg>";
        } else {
            img.src = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='300' viewBox='0 0 300 300'><rect width='100%' height='100%' fill='%23f3f4f6'/><path d='M150 110 L190 170 L110 170 Z' fill='%239ca3af'/><circle cx='135' cy='135' r='8' fill='%23ffffff'/></svg>";
        }
        imgLoaded(img);
    }
}

/* ─── SPA AJAX Loading to prevent page jump/scroll reset ─── */
function loadPage(url) {
    dimGrid();
    
    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Response error');
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Swap Category Chips active states
            const newCatRow = doc.querySelector('.cat-icon-row');
            const currentCatRow = document.querySelector('.cat-icon-row');
            if (newCatRow && currentCatRow) {
                currentCatRow.innerHTML = newCatRow.innerHTML;
            }
            
            // Swap Products and filters section
            const newProducts = doc.querySelector('#products');
            const currentProducts = document.querySelector('#products');
            if (newProducts && currentProducts) {
                currentProducts.innerHTML = newProducts.innerHTML;
            }
            
            // Update URL in browser history
            history.pushState(null, '', url);
            
            // Re-trigger favorites and cached images checks
            updateFavButtonsUI();
            updateFavoritesChipURL();
            document.querySelectorAll('.img-real, .img-banner').forEach(img => {
                if (img.complete && img.naturalHeight > 0) {
                    imgLoaded(img);
                }
            });
        })
        .catch(err => {
            console.error('AJAX loading failed, doing full reload:', err);
            window.location.href = url;
        });
}

function dimGrid() {
    const grid = document.querySelector('#products > .grid');
    if (grid) grid.classList.add('grid-dimmed');
}

// Listen to back/forward navigation
window.addEventListener('popstate', () => {
    dimGrid();
    fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            const newCatRow = doc.querySelector('.cat-icon-row');
            const currentCatRow = document.querySelector('.cat-icon-row');
            if (newCatRow && currentCatRow) {
                currentCatRow.innerHTML = newCatRow.innerHTML;
            }
            
            const newProducts = doc.querySelector('#products');
            const currentProducts = document.querySelector('#products');
            if (newProducts && currentProducts) {
                currentProducts.innerHTML = newProducts.innerHTML;
            }
            
            updateFavButtonsUI();
            updateFavoritesChipURL();
            document.querySelectorAll('.img-real, .img-banner').forEach(img => {
                if (img.complete && img.naturalHeight > 0) {
                    imgLoaded(img);
                }
            });
        })
        .catch(() => window.location.reload());
});

// Event delegation for Form Submissions (Filters)
document.addEventListener('submit', event => {
    if (event.target.id === 'filter-form') {
        event.preventDefault();
        const formData = new FormData(event.target);
        const params = new URLSearchParams();
        
        for (const [key, value] of formData.entries()) {
            if (value) params.append(key, value);
        }
        
        // Preserve global search query 'q' if available in query params
        const currentUrl = new URL(window.location.href);
        if (currentUrl.searchParams.has('q') && !params.has('q')) {
            params.append('q', currentUrl.searchParams.get('q'));
        }
        
        const action = event.target.getAttribute('action') || window.location.pathname;
        const url = action.split('?')[0] + '?' + params.toString();
        loadPage(url);
    }
});

// Event delegation for Clicks (Category Icon Chips, Pagination, Reset Button)
document.addEventListener('click', event => {
    // 0. Wishlist Header Button
    const wishlistBtn = event.target.closest('#wishlist-header-btn');
    if (wishlistBtn && wishlistBtn.getAttribute('href') !== '#') {
        event.preventDefault();
        loadPage(wishlistBtn.href);
        return;
    }

    // 1. Category icons chips
    const catChip = event.target.closest('.cat-icon-chip');
    if (catChip && catChip.getAttribute('href') !== '#') {
        event.preventDefault();
        loadPage(catChip.href);
        return;
    }
    
    // 2. Pagination pages
    const pagLink = event.target.closest('.pagination a, [rel="next"], [rel="prev"]');
    if (pagLink && pagLink.href) {
        event.preventDefault();
        loadPage(pagLink.href);
        return;
    }
    
    // 3. Reset Button inside filter form
    const resetBtn = event.target.closest('#products a');
    if (resetBtn && resetBtn.href && !resetBtn.closest('.product-card') && !resetBtn.closest('.pagination')) {
        event.preventDefault();
        loadPage(resetBtn.href);
        return;
    }
    
    // 4. Filter Panel Toggle (delegated)
    const filterToggle = event.target.closest('#filter-toggle');
    if (filterToggle) {
        const filterPanel = document.getElementById('filter-panel');
        if (filterPanel) {
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
        }
    }
});

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

/* ─── Wishlist (LocalStorage) & Web Share API ─────────────── */
function updateFavButtonsUI() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    document.querySelectorAll('[id^="fav-btn-"]').forEach(btn => {
        const id = parseInt(btn.id.replace('fav-btn-', ''));
        const svg = btn.querySelector('.fav-icon');
        if (svg) {
            if (favorites.includes(id)) {
                svg.classList.add('active');
                btn.style.color = '#FF6200';
                btn.setAttribute('aria-label', 'Hapus dari disimpan');
            } else {
                svg.classList.remove('active');
                btn.style.color = '#737373';
                btn.setAttribute('aria-label', 'Simpan ke favorit');
            }
        }
    });
}

function updateFavoritesChipURL() {
    const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    
    // Update Badge
    const badge = document.getElementById('wishlist-badge');
    if (badge) {
        if (favorites.length > 0) {
            badge.textContent = favorites.length;
            badge.classList.remove('hidden');
            badge.style.display = 'flex';
        } else {
            badge.classList.add('hidden');
            badge.style.display = 'none';
        }
    }
    
    const wishlistBtn = document.getElementById('wishlist-header-btn');
    if (wishlistBtn) {
        const isFavoritesActive = window.location.search.includes('favorites=');
        const url = new URL(window.location.href);
        
        if (isFavoritesActive) {
            url.searchParams.delete('favorites');
            url.searchParams.delete('page');
            wishlistBtn.href = url.toString();
        } else {
            if (favorites.length > 0) {
                url.searchParams.set('favorites', favorites.join(','));
            } else {
                url.searchParams.set('favorites', '');
            }
            url.searchParams.delete('page');
            wishlistBtn.href = url.toString();
        }
        
        // Styling active state
        if (isFavoritesActive) {
            wishlistBtn.classList.add('active');
            wishlistBtn.style.color = '#FF6200';
            wishlistBtn.style.borderColor = '#FF6200';
            wishlistBtn.style.backgroundColor = '#FFF3EC';
            if (badge) {
                badge.style.backgroundColor = '#FF6200';
            }
        } else {
            wishlistBtn.classList.remove('active');
            wishlistBtn.style.color = '#737373';
            wishlistBtn.style.borderColor = '#E4E4E7';
            wishlistBtn.style.backgroundColor = 'transparent';
            if (badge) {
                badge.style.backgroundColor = '#737373';
            }
        }
    }
}

function toggleFavorite(event, productId) {
    event.preventDefault();
    event.stopPropagation();
    
    let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
    const index = favorites.indexOf(productId);
    
    if (index > -1) {
        favorites.splice(index, 1);
        localStorage.setItem('favorites', JSON.stringify(favorites));
        
        // Animasi fade-out jika berada di tab Disimpan
        if (window.location.search.includes('favorites=')) {
            const card = event.target.closest('.product-card');
            if (card) {
                card.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.93)';
                setTimeout(() => {
                    card.remove();
                    if (document.querySelectorAll('.product-card').length === 0) {
                        window.location.href = '{{ route("catalog.home") }}?favorites=';
                    }
                }, 250);
            }
        }
    } else {
        favorites.push(productId);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }
    
    updateFavButtonsUI();
    updateFavoritesChipURL();
}

function shareProduct(event, name, url) {
    event.preventDefault();
    event.stopPropagation();
    
    if (navigator.share) {
        navigator.share({
            title: name,
            text: `Lihat ${name} di Etalasia!`,
            url: url
        }).catch(err => console.log('Error sharing:', err));
    } else {
        navigator.clipboard.writeText(url).then(() => {
            showToast("Tautan produk berhasil disalin!");
        }).catch(err => console.error('Gagal menyalin:', err));
    }
}

function showToast(message) {
    // Check if toast already exists
    let toast = document.getElementById('toast-notification');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast-notification';
        toast.className = "fixed bottom-20 left-1/2 -translate-x-1/2 bg-black/85 text-white text-xs px-4 py-2.5 rounded-full z-50 transition-opacity duration-300 shadow-md font-semibold text-center";
        document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.style.opacity = '1';
    
    setTimeout(() => {
        toast.style.opacity = '0';
    }, 2000);
}

// Inisialisasi UI saat dimuat
document.addEventListener('DOMContentLoaded', () => {
    updateFavButtonsUI();
    updateFavoritesChipURL();
    
    // Pengecekan gambar yang sudah selesai di-load (cached) agar skeleton tidak stuck
    document.querySelectorAll('.img-real, .img-banner').forEach(img => {
        if (img.complete && img.naturalHeight > 0) {
            imgLoaded(img);
        }
    });
});
</script>
@endpush
