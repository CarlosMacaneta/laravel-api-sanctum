<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('product/add', [ProductController::class, 'store'])->name('products.store');
Route::get('product/{id}/show', [ProductController::class, 'show'])->name('products.show');
Route::put('product/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('product/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
