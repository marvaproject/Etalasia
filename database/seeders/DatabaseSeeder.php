<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Etalasia Admin',
            'email' => 'admin@etalasia.test',
        ]);

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
            'name' => 'Daily Glow Serum',
            'slug' => 'daily-glow-serum',
            'image_url' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=900&q=80',
            'display_price' => 'Rp79.000',
            'price' => 79000,
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 1,
            'shopee_url' => 'https://shopee.co.id/',
            'tiktok_url' => 'https://www.tiktok.com/',
        ]);

        Product::create([
            'category_id' => $gadget->id,
            'name' => 'Compact Fast Charger',
            'slug' => 'compact-fast-charger',
            'image_url' => 'https://images.unsplash.com/photo-1618577608401-14f1f8f8d4d5?auto=format&fit=crop&w=900&q=80',
            'display_price' => 'Rp120.000',
            'price' => 120000,
            'is_active' => true,
            'sort_order' => 2,
            'shopee_url' => 'https://shopee.co.id/',
        ]);

        Banner::create([
            'title' => 'Promo Pilihan Minggu Ini',
            'image_url' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?auto=format&fit=crop&w=1400&q=80',
            'target_url' => 'https://shopee.co.id/',
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
