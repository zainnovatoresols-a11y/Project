<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CRUDController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Livewire\ProductSearch;

Route::get('/', function () {
    // dd(app());
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    // dd(app());
    return view('login');
})->name('login');

Route::resource('products', ProductController::class);
Route::get('posts', [PostController::class, 'index']);
Route::middleware(['auth:user,admin'])->group(function () {
    Route::resource('post', PostController::class);
});



Route::resource('users', UserController::class);
Route::get('register', [UserController::class, 'create'])->name('users.create');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::resource('crud', CRUDController::class);



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:user')->group(function () {
    Route::get('/user-dashboard', function () {
        return view('users.dashboard');
    })->name('user.dashboard');

    Route::get('/Add-Image', function () {
        return view('image');
    })->name('Add-Image');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});




Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

Route::post('/upload-image', [ImageController::class, 'store'])
    ->name('image.upload');


Route::livewire('/post/created', 'pages::post.create');
