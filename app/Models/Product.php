<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'category_id',
    'name',
    'slug',
    'image_path',
    'image_url',
    'display_price',
    'price',
    'is_active',
    'is_featured',
    'sort_order',
    'shopee_url',
    'tiktok_url',
    'shopee_clicks',
    'tiktok_clicks',
])]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'shopee_clicks' => 'integer',
            'tiktok_clicks' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageSrcAttribute(): string
    {
        if ($this->image_path) {
            return Storage::disk('public')->url($this->image_path);
        }

        return $this->image_url ?: asset('images/product-placeholder.svg');
    }

    public function hasMarketplace(string $marketplace): bool
    {
        return match ($marketplace) {
            'shopee' => filled($this->shopee_url),
            'tiktok' => filled($this->tiktok_url),
            default => false,
        };
    }

    public function affiliateUrl(string $marketplace): ?string
    {
        return match ($marketplace) {
            'shopee' => $this->shopee_url,
            'tiktok' => $this->tiktok_url,
            default => null,
        };
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
