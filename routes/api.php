<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// Testing API's
Route::get('/greet', [UserController::class, 'greet']);
Route::get('/greet2', [UserController::class, 'greet2']);
// Testing API's

// Product API's
Route::get('/products', [UserController::class, 'index']);

Route::get('/products/search/{name}', [UserController::class, 'search']);

Route::get('/products/{id}', [UserController::class, 'show']);

Route::delete('/products/{id}', [UserController::class, 'destroy']);

Route::put('/products', [UserController::class, 'update']);

Route::post('/products', [UserController::class, 'store']);
// Product API's

Route::group(['middleware' => ['auth:sanctum']], function() { 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
});
