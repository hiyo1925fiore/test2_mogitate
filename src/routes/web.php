<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/products',[ProductsController::class, 'index']);
Route::get('/products/register',[ProductsController::class, 'register']);
Route::post('/products/register',[ProductsController::class, 'store']);
Route::get('/products/search',[ProductsController::class,'search']);
Route::get('/products/{id}',[ProductsController::class, 'detail']);
Route::patch('/products/{id}/update',[ProductsController::class, 'update']);
Route::delete('/products/{id}/delete',[ProductsController::class, 'destroy']);