<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// URL sẽ đẹp dạng: domain.com/menu/tra-sua-tran-chau
Route::get('/menu/{product}', [HomeController::class, 'detail'])->name('product.detail');