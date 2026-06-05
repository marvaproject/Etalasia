<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function home(Request $request): View
    {
        return $this->catalogView($request);
    }

    public function category(Request $request, Category $category): View
    {
        abort_unless($category->is_active, 404);

        return $this->catalogView($request, $category);
    }

    private function catalogView(Request $request, ?Category $selectedCategory = null): View
    {
        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $banners = Banner::active()
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $products = Product::query()
            ->active()
            ->with('category')
            ->whereHas('category', fn (Builder $query) => $query->active())
            ->when($selectedCategory, fn (Builder $query) => $query->whereBelongsTo($selectedCategory))
            ->when($request->has('favorites'), function (Builder $query) use ($request) {
                $ids = array_filter(array_map('intval', explode(',', $request->string('favorites')->toString())));
                $query->whereIn('id', $ids);
            })
            ->when($request->filled('q'), function (Builder $query) use ($request) {
                $q = $request->string('q')->toString();
                // Cari berdasarkan nama ATAU nomor produk (contoh: "#42" atau "42")
                $codeSearch = (int) ltrim($q, '#');
                $query->where(function (Builder $sub) use ($q, $codeSearch) {
                    $sub->where('name', 'like', '%'.$q.'%')
                        ->orWhere(function (Builder $codeQuery) use ($codeSearch) {
                            if ($codeSearch > 0) {
                                $codeQuery->where('product_code', $codeSearch);
                            }
                        });
                });
            })
            ->when($request->filled('category') && ! $selectedCategory, function (Builder $query) use ($request) {
                $query->whereHas('category', fn (Builder $categoryQuery) => $categoryQuery->where('slug', $request->string('category')));
            })
            ->when($request->filled('marketplace'), function (Builder $query) use ($request) {
                match ($request->string('marketplace')->toString()) {
                    'shopee' => $query->whereNotNull('shopee_url'),
                    'tiktok' => $query->whereNotNull('tiktok_url'),
                    default => null,
                };
            })
            ->when($request->filled('min_price'), fn (Builder $query) => $query->where('price', '>=', $request->integer('min_price')))
            ->when($request->filled('max_price'), fn (Builder $query) => $query->where('price', '<=', $request->integer('max_price')));

        match ($request->string('sort')->toString()) {
            'price_asc' => $products->orderBy('price')->orderBy('sort_order'),
            'price_desc' => $products->orderByDesc('price')->orderBy('sort_order'),
            'newest' => $products->latest(),
            default => $products->orderByDesc('is_featured')->orderBy('sort_order')->latest(),
        };

        return view('catalog.index', [
            'banners' => $banners,
            'categories' => $categories,
            'products' => $products->paginate(12)->withQueryString(),
            'selectedCategory' => $selectedCategory,
        ]);
    }
}
