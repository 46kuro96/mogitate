<?php

use App\Http\Requests\MogitateRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MogitateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [MogitateController::class, 'products']);
Route::get('/products/register', [MogitateController::class, 'register']);
Route::post('/products', [MogitateController::class, 'store']);
Route::get('/products/{id}',[MogitateController::class, 'productld'])->name('productld');

Route::patch('products/{id}', [MogitateController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [MogitateController::class, 'destroy'])->name('products.delete');
Route::get('/search', [MogitateController::class, 'search'])->name('products.search');