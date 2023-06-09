<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // category routes
    Route::controller(CategoryController::class)->group(function () {

        Route::get('/category', 'index')->name('category');
        Route::get('/category/create', 'create')->name('category.create');
        Route::POST('/category/store', 'store')->name('category.store');
        Route::get('/category/{category}/edit', 'edit')->name('category.edit');
        Route::PUT('/category/{category}', 'update')->name('category.update');
        Route::DELETE('/category/{category}/delete', 'delete')->name('category.delete');
    });

    // Brands Routes
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class)->name('brand');

    // Grouping

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('product');
        Route::get('/products/create', 'createProduct')->name('product.create');
        Route::POST('/products/store', 'createstore')->name('product.store');
        Route::get('/products/{product}/edit', 'editProduct')->name('product.edit');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
