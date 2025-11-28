<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// URL sẽ đẹp dạng: domain.com/menu/tra-sua-tran-chau
Route::get('/menu/{product}', [HomeController::class, 'detail'])->name('product.detail');

// Trang About Us
Route::get('/about-us', function () {
    return view('about', [
        'meta_title' => 'Về Chúng Tôi | DrinkStore',
        'meta_desc' => 'Câu chuyện về hành trình mang đến những ly đồ uống ngon nhất.'
    ]);
})->name('about');

use App\Http\Controllers\AdminProductController;

// Gom nhóm các route Admin lại
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminProductController::class, 'index'])->name('index');
    Route::get('/create', [AdminProductController::class, 'create'])->name('create');
    Route::post('/store', [AdminProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('edit'); // Laravel tự hiểu tìm theo ID
    Route::put('/update/{id}', [AdminProductController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [AdminProductController::class, 'destroy'])->name('delete');
});

Route::get('/search', [HomeController::class, 'search'])->name('search');