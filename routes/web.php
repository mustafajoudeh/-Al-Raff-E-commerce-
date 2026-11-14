<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::put('/users/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::get('/users/{id}', [UserController::class, 'show'])
        ->name('users.show');

    Route::patch('/users/{id}/status', [UserController::class, 'toggleStatus'])
        ->name('users.toggleStatus');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');
});