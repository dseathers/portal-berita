<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/registrasi', [AuthController::class, 'register']);
Route::get('/', [NewsController::class, 'showWelcomePage']);
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NewsController::class, 'dashboard'])->name('dashboard');
    Route::get('/upload', [NewsController::class, 'upload'])->name('upload');//route tampilan upload
    Route::post('/uploadnews', [NewsController::class, 'store']);
    Route::get('/newslist', [NewsController::class, 'index']);
    Route::get('/listberita', [NewsController::class, 'newslist'])->name('listberita');//route tampilan
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/latest-news', [NewsController::class, 'latestNews'])->name('latestNews');

});