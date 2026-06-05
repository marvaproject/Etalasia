<?php

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
    Storage::fake('public');
});

it('has import action on list products page', function () {
    Livewire::test(ListProducts::class)
        ->assertActionExists('import');
});

it('can import products from a valid CSV file and auto assigns category icons', function () {
    // Create temporary CSV data with shopee_url and tiktok_url
    $csvContent = "nama_produk,harga,shopee_url,tiktok_url,url_gambar,kategori\n" .
        "\"Kemeja Flanel Premium\",\"Rp125.000\",\"https://shopee.co.id/product-123\",\"\",\"https://images.unsplash.com/photo-1\",\"Fashion Baju\"\n" .
        "\"Serum Glowing\",\"Rp50.000 - Rp150.000\",\"\",\"https://www.tiktok.com/product-456\",\"https://images.unsplash.com/photo-2\",\"Kecantikan\"\n" .
        "\"Barang Lain\",\"15000\",\"https://other-link.com\",\"\",\"\",\"Lainnya\"\n" .
        "\"Barang Tanpa Link\",\"12000\",\"\",\"\",\"\",\"Lainnya\""; // Should be skipped/failed because both links are empty

    $file = UploadedFile::fake()->createWithContent('import.csv', $csvContent);
    $path = Storage::disk('public')->putFileAs('temp-imports', $file, 'import.csv');

    Livewire::test(ListProducts::class)
        ->callAction('import', [
            'file' => [$path],
        ])
        ->assertHasNoActionErrors();

    // Verify categories were created with correct fallback icons
    $fashionCategory = Category::where('name', 'Fashion Baju')->first();
    expect($fashionCategory)->not->toBeNull();
    expect($fashionCategory->icon)->toBe('tabler-shirt');

    $beautyCategory = Category::where('name', 'Kecantikan')->first();
    expect($beautyCategory)->not->toBeNull();
    expect($beautyCategory->icon)->toBe('tabler-sparkles');

    $otherCategory = Category::where('name', 'Lainnya')->first();
    expect($otherCategory)->not->toBeNull();
    expect($otherCategory->icon)->toBe('tabler-tag'); // Default fallback

    // Verify only the 3 products with at least one filled link were created (Product 4 is skipped)
    expect(Product::count())->toBe(3);

    // Product 1
    $p1 = Product::where('name', 'Kemeja Flanel Premium')->first();
    expect($p1)->not->toBeNull();
    expect($p1->price)->toEqual(125000.00);
    expect($p1->display_price)->toBe('Rp125.000');
    expect($p1->shopee_url)->toBe('https://shopee.co.id/product-123');
    expect($p1->tiktok_url)->toBeNull();
    expect($p1->product_code)->toBe(1); // Gap filling code
    expect($p1->slug)->toBe('kemeja-flanel-premium');

    // Product 2
    $p2 = Product::where('name', 'Serum Glowing')->first();
    expect($p2)->not->toBeNull();
    expect($p2->price)->toEqual(50000.00); // Lowest from range
    expect($p2->display_price)->toBe('Rp50.000 - Rp150.000');
    expect($p2->shopee_url)->toBeNull();
    expect($p2->tiktok_url)->toBe('https://www.tiktok.com/product-456');

    // Product 3
    $p3 = Product::where('name', 'Barang Lain')->first();
    expect($p3)->not->toBeNull();
    expect($p3->price)->toEqual(15000.00);
    expect($p3->shopee_url)->toBe('https://other-link.com');
    expect($p3->tiktok_url)->toBeNull();

    // Verify that "Barang Tanpa Link" is NOT in the database
    $p4 = Product::where('name', 'Barang Tanpa Link')->first();
    expect($p4)->toBeNull();
});

it('can import products from a valid JSON file', function () {
    $jsonContent = json_encode([
        [
            "nama_produk" => "Celana Jeans Slim Fit",
            "harga" => "Rp199.000",
            "shopee_url" => "https://shopee.co.id/jeans",
            "tiktok_url" => "",
            "url_gambar" => "https://example.com/jeans.jpg",
            "kategori" => "Fashion Celana"
        ],
        [
            "nama_produk" => "Earbuds Wireless",
            "harga" => "Rp350.000",
            "shopee_url" => "",
            "tiktok_url" => "https://www.tiktok.com/earbuds",
            "url_gambar" => "",
            "kategori" => "Elektronik"
        ],
        [
            "nama_produk" => "Produk Tanpa Link",
            "harga" => "Rp10.000",
            "shopee_url" => "",
            "tiktok_url" => "",
            "url_gambar" => "",
            "kategori" => "Elektronik"
        ] // Should be skipped/failed because both links are empty
    ]);

    $file = UploadedFile::fake()->createWithContent('import.json', $jsonContent);
    $path = Storage::disk('public')->putFileAs('temp-imports', $file, 'import.json');

    Livewire::test(ListProducts::class)
        ->callAction('import', [
            'file' => [$path],
        ])
        ->assertHasNoActionErrors();

    // Only 2 products should be imported
    expect(Product::count())->toBe(2);

    $p1 = Product::where('name', 'Celana Jeans Slim Fit')->first();
    expect($p1)->not->toBeNull();
    expect($p1->price)->toEqual(199000.00);
    expect($p1->category->icon)->toBe('tabler-shirt');

    $p2 = Product::where('name', 'Earbuds Wireless')->first();
    expect($p2)->not->toBeNull();
    expect($p2->price)->toEqual(350000.00);
    expect($p2->category->icon)->toBe('tabler-device-mobile');

    $p3 = Product::where('name', 'Produk Tanpa Link')->first();
    expect($p3)->toBeNull();
});
