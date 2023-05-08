<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::resource('products', ProductController::class); 
// => To get all routes

Route::post('/register', [AuthController::class, 'register']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/search/{name}', [ProductController::class, 'search']);

Route::get('/products/{id}', [ProductController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/produtcs/{id}', [ProductController::class, 'destroy']);
});
