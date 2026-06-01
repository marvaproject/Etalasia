<?php

use App\Http\Controllers\AffiliateRedirectController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'home'])->name('catalog.home');
Route::get('/kategori/{category:slug}', [CatalogController::class, 'category'])->name('catalog.category');

Route::get('/go/product/{product}/{marketplace}', [AffiliateRedirectController::class, 'product'])->name('affiliate.product');
Route::get('/go/banner/{banner}', [AffiliateRedirectController::class, 'banner'])->name('affiliate.banner');
