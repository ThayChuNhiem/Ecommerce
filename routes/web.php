<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ShopController;



Route::prefix('')->name('user.')->group(function () {
    
    Route::get('', [HomepageController::class, 'index'])
        ->name('home');
    Route::get('shop', [HomepageController::class, 'shop'])
        ->name('shop');
    Route::get('/search', [HomepageController::class, 'search'])
        ->name('search');
    Route::get('/cart', [HomepageController::class, 'showCart'])
        ->name('cart');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('admin.dashboard');


    //Product
    Route::get('/products', [ProductController::class, 'index'])
        ->name('admin.product');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('admin.product.create');

    Route::get('/products/update', [ProductController::class, 'create'])
        ->name('admin.product.update');

    Route::post('/products/save', [ProductController::class, 'save'])
        ->name('admin.product.save');

    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])
        ->name('admin.product.edit');

    Route::put('/products/edit/{id}', [ProductController::class, 'update'])
        ->name('admin.product.update');

    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])
        ->name('admin.product.delete');


    //Category
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('admin.category');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        ->name('admin.category.create');

    Route::get('/categories/update', [CategoryController::class, 'create'])
        ->name('admin.category.update');

    Route::post('/categories/save', [CategoryController::class, 'save'])
        ->name('admin.category.save');

    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])
        ->name('admin.category.edit');

    Route::put('/categories/edit/{id}', [CategoryController::class, 'update'])
        ->name('admin.category.update');

    Route::get('/categories/delete/{id}', [CategoryController::class, 'delete'])
        ->name('admin.category.delete');


    //Discount
    Route::get('/discount', [DiscountController::class, 'index'])
        ->name('admin.discount');

    Route::get('/admin/discount/create', [DiscountController::class, 'create'])
        ->name('admin.discount.create');

    Route::post('/admin/discount/save', [DiscountController::class, 'store'])
        ->name('admin.discount.save');

    Route::get('/admin/discount/edit/{id}', [DiscountController::class, 'edit'])
        ->name('admin.discount.edit');

    Route::put('/admin/discount/update/{id}', [DiscountController::class, 'update'])
        ->name('admin.discount.update');

    Route::get('/admin/discount/delete/{id}', [DiscountController::class, 'delete'])
        ->name('admin.discount.delete');

    //shop

    Route::get('/shop', [ShopController::class, 'index'])
        ->name('admin.shop');

    Route::get('/shop/create', [ShopController::class, 'create'])
        ->name('admin.shop.create');

    Route::post('/shop/save', [ShopController::class, 'store'])
        ->name('admin.shop.save');

    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])
        ->name('admin.shop.edit');

    Route::put('/shop/update/{id}', [ShopController::class, 'update'])
        ->name('admin.shop.update');

    Route::get('/shop/delete/{id}', [ShopController::class, 'delete'])
        ->name('admin.shop.delete');
});

require __DIR__ . '/auth.php';
