<?php

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('shows active catalog content and hides inactive content', function () {
    $activeCategory = Category::create([
        'name' => 'Beauty Picks',
        'slug' => 'beauty-picks',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    Category::create([
        'name' => 'Hidden Category',
        'slug' => 'hidden-category',
        'is_active' => false,
        'sort_order' => 2,
    ]);

    Product::create([
        'category_id' => $activeCategory->id,
        'name' => 'Serum Cerah',
        'slug' => 'serum-cerah',
        'image_url' => 'https://example.com/serum.jpg',
        'display_price' => 'Rp79.000',
        'price' => 79000,
        'is_active' => true,
        'is_featured' => true,
        'sort_order' => 1,
        'shopee_url' => 'https://shopee.co.id/serum',
    ]);

    Product::create([
        'category_id' => $activeCategory->id,
        'name' => 'Produk Nonaktif',
        'slug' => 'produk-nonaktif',
        'image_url' => 'https://example.com/hidden.jpg',
        'display_price' => 'Rp10.000',
        'price' => 10000,
        'is_active' => false,
        'sort_order' => 2,
        'tiktok_url' => 'https://www.tiktok.com/hidden',
    ]);

    Banner::create([
        'title' => 'Flash Sale',
        'image_url' => 'https://example.com/banner.jpg',
        'target_url' => 'https://shopee.co.id/flash-sale',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Etalasia')
        ->assertSee('Beauty Picks')
        ->assertSee('Serum Cerah')
        ->assertSee('Flash Sale')
        ->assertDontSee('Hidden Category')
        ->assertDontSee('Produk Nonaktif');
});

it('filters products by search category marketplace price and sort', function () {
    $beauty = Category::create([
        'name' => 'Beauty',
        'slug' => 'beauty',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $gadget = Category::create([
        'name' => 'Gadget',
        'slug' => 'gadget',
        'is_active' => true,
        'sort_order' => 2,
    ]);

    Product::create([
        'category_id' => $beauty->id,
        'name' => 'Lip Tint TikTok',
        'slug' => 'lip-tint-tiktok',
        'image_url' => 'https://example.com/lip.jpg',
        'display_price' => 'Rp45.000',
        'price' => 45000,
        'is_active' => true,
        'sort_order' => 1,
        'tiktok_url' => 'https://www.tiktok.com/lip',
    ]);

    Product::create([
        'category_id' => $gadget->id,
        'name' => 'Charger Shopee',
        'slug' => 'charger-shopee',
        'image_url' => 'https://example.com/charger.jpg',
        'display_price' => 'Rp120.000',
        'price' => 120000,
        'is_active' => true,
        'sort_order' => 2,
        'shopee_url' => 'https://shopee.co.id/charger',
    ]);

    $this->get('/?q=lip&category=beauty&marketplace=tiktok&min_price=30000&max_price=60000&sort=price_asc')
        ->assertOk()
        ->assertSee('Lip Tint TikTok')
        ->assertDontSee('Charger Shopee');
});

it('tracks product and banner clicks before redirecting', function () {
    $category = Category::create([
        'name' => 'Fashion',
        'slug' => 'fashion',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Tas TikTok',
        'slug' => 'tas-tiktok',
        'image_url' => 'https://example.com/tas.jpg',
        'display_price' => 'Rp99.000',
        'price' => 99000,
        'is_active' => true,
        'sort_order' => 1,
        'tiktok_url' => 'https://www.tiktok.com/tas',
    ]);

    $banner = Banner::create([
        'title' => 'Promo Tas',
        'image_url' => 'https://example.com/promo.jpg',
        'target_url' => 'https://www.tiktok.com/promo-tas',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $this->get(route('affiliate.product', [$product, 'tiktok']))
        ->assertRedirect('https://www.tiktok.com/tas');

    $this->get(route('affiliate.banner', $banner))
        ->assertRedirect('https://www.tiktok.com/promo-tas');

    expect($product->fresh()->tiktok_clicks)->toBe(1)
        ->and($banner->fresh()->clicks)->toBe(1);
});
