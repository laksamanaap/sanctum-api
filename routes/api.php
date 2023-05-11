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

// Non auth API's (OA Swagger)
Route::get('/products', [UserController::class, 'index']);

Route::get('/products/search/{name}', [UserController::class, 'search']);

Route::get('/products/{id}', [UserController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);
Route::delete('/products/{id}', [UserController::class, 'destroy']);
Route::put('/products', [UserController::class, 'update']);
Route::post('/products', [UserController::class, 'store']);  
// Non auth API's (OA Swagger)


// API's w Auth
Route::group(['middleware' => ['auth:sanctum']], function() { 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::put('/products', [ProductController::class, 'update']);
    Route::post('/products', [ProductController::class, 'store']);
}); 
// API's w Auth
