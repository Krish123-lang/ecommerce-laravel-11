<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brand/add', [AdminController::class, 'add_brand'])->name('admin.brand.add');
    Route::post('/admin/brand/store', [AdminController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}', [AdminController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update', [AdminController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete', [AdminController::class, 'brand_delete'])->name('admin.brand.delete');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [AdminController::class, 'categories_add'])->name('admin.categories.add');
    Route::post('/admin/categories/store', [AdminController::class, 'categories_store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'categories_edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update', [AdminController::class, 'categories_update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}/delete', [AdminController::class, 'categories_delete'])->name('admin.categories.delete');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [AdminController::class, 'products_add'])->name('admin.products.add');
    Route::post('/admin/products/store', [AdminController::class, 'products_store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'products_edit'])->name('admin.products.edit');
    Route::put('/admin/products/update', [AdminController::class, 'products_update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}/delete', [AdminController::class, 'products_delete'])->name('admin.products.delete');
});