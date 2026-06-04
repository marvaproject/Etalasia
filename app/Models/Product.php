<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'price'          => 'decimal:2',
            'is_active'      => 'boolean',
            'is_featured'    => 'boolean',
            'sort_order'     => 'integer',
            'shopee_clicks'  => 'integer',
            'tiktok_clicks'  => 'integer',
            'product_code'   => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {

            // 0. Slug — generate dari nama jika belum ada
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }

            // 1. Gap-fill: cari product_code terkecil yang belum terpakai
            if (empty($product->product_code)) {
                $used = static::orderBy('product_code')
                    ->pluck('product_code')
                    ->all();

                $next = 1;
                foreach ($used as $code) {
                    if ($code !== $next) {
                        break;
                    }
                    $next++;
                }
                $product->product_code = $next;
            }

            // 2. Sort order: append ke belakang (max + 1)
            if (is_null($product->sort_order)) {
                $product->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });

        // Saat DELETE — tidak ada resequence.
        // Nomor yang dihapus akan diisi ulang oleh produk baru berikutnya.
    }

    /**
     * (Utility) Re-number semua product_code secara berurutan (1, 2, 3…).
     * Tidak dipanggil otomatis — hanya untuk reset manual jika diperlukan.
     */
    public static function resequence(): void
    {
        $ids = static::orderBy('id')->pluck('id');

        DB::transaction(function () use ($ids) {
            foreach ($ids as $index => $id) {
                static::withoutTimestamps(
                    fn () => static::where('id', $id)->update(['product_code' => $index + 1])
                );
            }
        });
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

    /**
     * Kode produk terformat: #001, #042, dst.
     */
    public function getFormattedCodeAttribute(): string
    {
        return '#' . str_pad((string) ($this->product_code ?? 0), 3, '0', STR_PAD_LEFT);
    }

    public function hasMarketplace(string $marketplace): bool
    {
        return match ($marketplace) {
            'shopee' => filled($this->shopee_url),
            'tiktok' => filled($this->tiktok_url),
            default  => false,
        };
    }

    public function affiliateUrl(string $marketplace): ?string
    {
        return match ($marketplace) {
            'shopee' => $this->shopee_url,
            'tiktok' => $this->tiktok_url,
            default  => null,
        };
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
