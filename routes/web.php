<?php

use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('units', App\Http\Controllers\UnitController::class);
Route::resource('weights', App\Http\Controllers\WeightController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('variants', App\Http\Controllers\VariantController::class);
Route::resource('taxes', App\Http\Controllers\TaxController::class);

Route::get('/get-attributesValue/{attributeId}', [VariantController::class, 'attributesValue']);
Route::post('/get-variant-details', [VariantController::class, 'getVariantDetails']);
