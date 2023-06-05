<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// auth related routes
Route::get('/', [UserController::class, 'homeContent'])->name('login');
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// blog related routes
Route::get('/create-post', [BlogController::class, 'showCreateForm'])->middleware('auth');
Route::post('/create', [BlogController::class, 'savePost'])->middleware('auth');
Route::get('/post/{post}', [BlogController::class, 'singlePost']);
Route::get('/edit/{post}', [BlogController::class,'showEditPage'])->middleware('can:update, post');
Route::put('/post/edit/{post}', [BlogController::class, 'updatePost'])->middleware('can:update, post');
Route::delete('/post/delete/{post}', [BlogController::class, 'deletePost'])->middleware('can:delete, post');

// profile
Route::get('/profile/{user:username}', [UserController::class, 'profile'])->middleware('auth');

// admin routes
Route::get('/admin-login', function (){
    return "Only Admin is allowed to see this page.";
})->middleware('can:visitAdminPage');

// upload avatar route
Route::get('/profile-upload', [UserController::class, 'showUploadPage'])->middleware('auth');
Route::post('/profile-upload', [UserController::class, 'profileUpload'])->middleware('auth');


// Following routes
Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('auth');
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('auth');

Route::get('/profile/{user:username}/followers', [UserController::class, 'profileFollowers'])->middleware('auth');
Route::get('/profile/{user:username}/following', [UserController::class, 'profileFollowing'])->middleware('auth');
