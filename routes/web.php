<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/logout', function () {
    return abort('404', 'Not Found');
})->name('logout');

Route::middleware(['auth','check.role:super admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('/dashboard')->group(function() {
        Route::get('/', function () {
            return view('dashboard.index');
        });
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
    });
});

require __DIR__.'/auth.php';

Auth::routes();