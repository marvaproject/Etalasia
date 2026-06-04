<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug', 'icon', 'image_path', 'image_url', 'is_active', 'sort_order'])]
class Category extends Model
{
    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            // Slug — generate dari nama
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }

            // Sort order — append ke belakang
            if (is_null($category->sort_order)) {
                $category->sort_order = (static::max('sort_order') ?? 0) + 1;
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
