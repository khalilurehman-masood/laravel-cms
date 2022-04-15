<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\postController as ControllersPostController;
use App\Http\Controllers\userController;

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/post/{slug}',[postController::class,'show','slug'])->name('post');