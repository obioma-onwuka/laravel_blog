<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Declared routes
Route::post('/v1/login', [UserController::class, 'loginApi']);
Route::post('/v1/create-post', [BlogController::class, 'newApiPost'])->middleware('auth:sanctum');
Route::delete('v1/delete-post/{post}', [BlogController::class, 'deleteApiPost'])->middleware('auth:sanctum');
