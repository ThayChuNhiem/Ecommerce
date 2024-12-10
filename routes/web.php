<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])
        ->name('admin.dashboard');


    //Product
    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.product');

    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.product.create');

    Route::get('/admin/products/update', [ProductController::class, 'create'])
        ->name('admin.product.update');

    Route::post('/admin/products/save', [ProductController::class, 'save'])
        ->name('admin.product.save');

    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])
        ->name('admin.product.edit');

    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])
        ->name('admin.product.update');

    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])
        ->name('admin.product.delete');


    //Category
    Route::get('/admin/categories', [CategoryController::class, 'index'])
        ->name('admin.category');

    Route::get('/admin/categories/create', [CategoryController::class, 'create'])
        ->name('admin.category.create');

    Route::get('/admin/categories/update', [CategoryController::class, 'create'])
        ->name('admin.category.update');

    Route::post('/admin/categories/save', [CategoryController::class, 'save'])
        ->name('admin.category.save');

    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])
        ->name('admin.category.edit');

    Route::put('/admin/categories/edit/{id}', [CategoryController::class, 'update'])
        ->name('admin.category.update');

    Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete'])
        ->name('admin.category.delete');
});

require __DIR__ . '/auth.php';

// Route::get('/admin/dashboard', [HomeController::class, 'index'])
// ->middleware(['auth', 'admin'])->name('admin.dashboard');
