<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Etalasia mengkurasi produk affiliate Shopee dan TikTok pilihan dalam katalog yang ringan dan mudah dibuka di mobile.">
    <title>{{ $selectedCategory ? $selectedCategory->name . ' - ' : '' }}Etalasia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f4ee] text-[#20211d] antialiased">
    <div class="min-h-screen">
        <header class="border-b border-[#ded6c7] bg-[#fffdf8]/95 backdrop-blur">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('catalog.home') }}" class="flex items-center gap-3" aria-label="Etalasia home">
                    <span class="grid size-10 place-items-center rounded-full bg-[#1f8a70] text-lg font-black text-white">E</span>
                    <span>
                        <span class="block text-xl font-black tracking-wide text-[#20211d]">Etalasia</span>
                        <span class="block text-xs font-semibold uppercase tracking-[0.18em] text-[#7c6f5c]">Affiliate Catalog</span>
                    </span>
                </a>

                <a href="#products" class="rounded-full border border-[#cfc4b4] px-4 py-2 text-sm font-bold text-[#20211d] transition hover:border-[#1f8a70] hover:text-[#1f8a70]">
                    Lihat Produk
                </a>
            </div>
        </header>

        <main>
            <section class="bg-[#fffdf8]">
                <div class="mx-auto grid max-w-6xl gap-8 px-4 py-8 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div class="space-y-5">
                        <p class="inline-flex rounded-full bg-[#e6f4ef] px-3 py-1 text-xs font-black uppercase tracking-[0.18em] text-[#1f8a70]">
                            Shopee & TikTok picks
                        </p>
                        <div class="space-y-3">
                            <h1 class="max-w-3xl text-4xl font-black leading-tight text-[#20211d] sm:text-5xl">
                                Katalog belanja affiliate yang rapi, cepat, dan langsung ke promo.
                            </h1>
                            <p class="max-w-2xl text-base leading-7 text-[#6e6355]">
                                Temukan pilihan produk dari Shopee dan TikTok dalam satu tempat. Filter sesuai kebutuhan, lalu buka link affiliate di tab baru.
                            </p>
                        </div>
                    </div>

                    @if ($banners->isNotEmpty())
                        <div class="grid gap-3">
                            @foreach ($banners->take(2) as $banner)
                                <a href="{{ route('affiliate.banner', $banner) }}" target="_blank" rel="noopener noreferrer" class="group overflow-hidden rounded-[28px] border border-[#ded6c7] bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                                    <img src="{{ $banner->image_src }}" alt="{{ $banner->title }}" class="aspect-[16/8] w-full object-cover" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
                                    <div class="flex items-center justify-between gap-3 px-5 py-4">
                                        <span class="font-black">{{ $banner->title }}</span>
                                        <span class="rounded-full bg-[#20211d] px-3 py-1 text-xs font-bold text-white transition group-hover:bg-[#1f8a70]">Buka</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-[28px] border border-[#ded6c7] bg-[#f2eadf] p-6">
                            <div class="aspect-[16/9] rounded-[22px] bg-[linear-gradient(135deg,#1f8a70,#f15a24_58%,#20211d)]"></div>
                        </div>
                    @endif
                </div>
            </section>

            <section class="border-y border-[#ded6c7] bg-[#f7f4ee]">
                <div class="mx-auto flex max-w-6xl gap-2 overflow-x-auto px-4 py-4 sm:px-6">
                    <a href="{{ route('catalog.home') }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-bold {{ $selectedCategory ? 'bg-white text-[#6e6355]' : 'bg-[#20211d] text-white' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('catalog.category', $category) }}" class="shrink-0 rounded-full px-4 py-2 text-sm font-bold {{ $selectedCategory?->is($category) ? 'bg-[#20211d] text-white' : 'bg-white text-[#6e6355] hover:text-[#1f8a70]' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </section>

            <section id="products" class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
                <form method="GET" action="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}" class="grid gap-3 rounded-[24px] border border-[#ded6c7] bg-[#fffdf8] p-4 shadow-sm sm:grid-cols-2 lg:grid-cols-6">
                    <label class="lg:col-span-2">
                        <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Cari</span>
                        <input name="q" value="{{ request('q') }}" type="search" placeholder="Nama produk" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                    </label>

                    @unless ($selectedCategory)
                        <label>
                            <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Kategori</span>
                            <select name="category" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                                <option value="">Semua</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    @endunless

                    <label>
                        <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Marketplace</span>
                        <select name="marketplace" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                            <option value="">Semua</option>
                            <option value="shopee" @selected(request('marketplace') === 'shopee')>Shopee</option>
                            <option value="tiktok" @selected(request('marketplace') === 'tiktok')>TikTok</option>
                            <option value="both" @selected(request('marketplace') === 'both')>Shopee + TikTok</option>
                        </select>
                    </label>

                    <label>
                        <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Harga Min</span>
                        <input name="min_price" value="{{ request('min_price') }}" type="number" min="0" placeholder="0" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                    </label>

                    <label>
                        <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Harga Max</span>
                        <input name="max_price" value="{{ request('max_price') }}" type="number" min="0" placeholder="999000" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                    </label>

                    <label>
                        <span class="mb-1 block text-xs font-black uppercase tracking-[0.14em] text-[#7c6f5c]">Sort</span>
                        <select name="sort" class="w-full rounded-2xl border border-[#d9cfbf] bg-white px-4 py-3 text-sm outline-none focus:border-[#1f8a70]">
                            <option value="">Unggulan</option>
                            <option value="newest" @selected(request('sort') === 'newest')>Terbaru</option>
                            <option value="price_asc" @selected(request('sort') === 'price_asc')>Termurah</option>
                            <option value="price_desc" @selected(request('sort') === 'price_desc')>Termahal</option>
                        </select>
                    </label>

                    <div class="flex items-end gap-2 lg:col-span-6">
                        <button class="rounded-2xl bg-[#1f8a70] px-5 py-3 text-sm font-black text-white transition hover:bg-[#176b57]">
                            Terapkan Filter
                        </button>
                        <a href="{{ $selectedCategory ? route('catalog.category', $selectedCategory) : route('catalog.home') }}" class="rounded-2xl border border-[#d9cfbf] px-5 py-3 text-sm font-black text-[#6e6355] transition hover:text-[#20211d]">
                            Reset
                        </a>
                    </div>
                </form>

                <div class="mt-8 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black">{{ $selectedCategory?->name ?? 'Produk Pilihan' }}</h2>
                        <p class="mt-1 text-sm text-[#6e6355]">{{ $products->total() }} produk ditemukan</p>
                    </div>
                </div>

                <div class="mt-5 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
                    @forelse ($products as $product)
                        <article class="group flex h-full flex-col overflow-hidden rounded-[20px] bg-white shadow-[0_4px_24px_-6px_rgba(0,0,0,0.06)] ring-1 ring-black/[0.04] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_32px_-8px_rgba(0,0,0,0.12)]">
                            <div class="relative shrink-0">
                                <img src="{{ $product->image_src }}" alt="{{ $product->name }}" class="aspect-square w-full bg-[#f7f4ee] object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                <span class="absolute right-3 top-3 max-w-[calc(100%-1.5rem)] truncate rounded-full bg-white/95 px-3 py-1.5 text-[11px] font-bold tracking-wide text-[#1f8a70] shadow-sm backdrop-blur">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            <div class="relative z-10 flex flex-1 flex-col bg-white p-4 sm:p-5">
                                <div class="space-y-1.5">
                                    <h3 class="line-clamp-2 text-sm font-bold leading-snug text-[#20211d]">{{ $product->name }}</h3>
                                    @if ($product->display_price)
                                        <p class="text-base font-black tracking-tight text-[#1f8a70]">{{ $product->display_price }}</p>
                                    @endif
                                </div>

                                <div class="mt-auto pt-5 grid grid-cols-{{ $product->shopee_url && $product->tiktok_url ? '2' : '1' }} gap-2">
                                    @if ($product->shopee_url)
                                        <a href="{{ route('affiliate.product', [$product, 'shopee']) }}" target="_blank" rel="noopener noreferrer" class="flex min-h-[44px] items-center justify-center rounded-xl bg-[#f15a24] px-3 text-[13px] font-bold text-white transition hover:bg-[#d84c1d] active:scale-95">
                                            Shopee
                                        </a>
                                    @endif
                                    @if ($product->tiktok_url)
                                        <a href="{{ route('affiliate.product', [$product, 'tiktok']) }}" target="_blank" rel="noopener noreferrer" class="flex min-h-[44px] items-center justify-center rounded-xl bg-[#20211d] px-3 text-[13px] font-bold text-white transition hover:bg-[#000] active:scale-95">
                                            TikTok
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full rounded-[24px] border border-dashed border-[#cfc4b4] bg-[#fffdf8] p-8 text-center">
                            <h3 class="text-lg font-black">Produk belum ditemukan</h3>
                            <p class="mt-2 text-sm text-[#6e6355]">Coba reset filter atau pilih kategori lain.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
