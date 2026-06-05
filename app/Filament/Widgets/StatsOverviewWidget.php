<?php

namespace App\Filament\Widgets;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected array|int|null $columns = null;

    protected function getStats(): array
    {
        $totalShopeeClicks = Product::sum('shopee_clicks');
        $totalTiktokClicks = Product::sum('tiktok_clicks');
        $totalBannerClicks = Banner::sum('clicks');

        return [
            Stat::make('Produk Aktif', Product::where('is_active', true)->count())
                ->description(Product::where('is_featured', true)->count() . ' produk unggulan')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),

            Stat::make('Kategori Aktif', Category::where('is_active', true)->count())
                ->description(Category::count() . ' total kategori')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),

            Stat::make('Klik Banner', number_format($totalBannerClicks))
                ->description(Banner::where('is_active', true)->count() . ' banner aktif')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('gray'),

            Stat::make('Klik Shopee', number_format($totalShopeeClicks))
                ->description('Total semua produk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),

            Stat::make('Klik TikTok', number_format($totalTiktokClicks))
                ->description('Total semua produk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),
        ];
    }
}
