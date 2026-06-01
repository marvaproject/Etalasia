<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class AffiliateRedirectController extends Controller
{
    public function product(Product $product, string $marketplace): RedirectResponse
    {
        abort_unless($product->is_active && $product->category?->is_active, 404);

        $url = $product->affiliateUrl($marketplace);

        abort_unless($url, 404);

        $column = "{$marketplace}_clicks";

        if (in_array($column, ['shopee_clicks', 'tiktok_clicks'], true)) {
            $product->increment($column);
        }

        return redirect()->away($url);
    }

    public function banner(Banner $banner): RedirectResponse
    {
        abort_unless($banner->is_active, 404);

        $banner->increment('clicks');

        return redirect()->away($banner->target_url);
    }
}
