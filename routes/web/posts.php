<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\postController as ControllersPostController;
use App\Http\Controllers\userController;



Route::get('/admin',[adminController::class,'index'])->name('admin')->middleware('auth');
Route::get('admin/posts/create',[PostController::class,'create'])->name('post.createNew')->middleware('auth');
Route::post('admin/posts',[PostController::class,'store'])->name('post.create')->middleware('auth');
Route::get('admin/posts/All',[PostController::class,'index'])->name('posts.all')->middleware('auth');
Route::get('admin/posts/allUsersPosts',[PostController::class,'allUsersPosts'])->name('posts.allUsersPosts')->middleware(['auth','role:admin']);

Route::delete('admin/posts/{postId}/delete',[PostController::class,'destroy','postId'])->name('post.delete')->middleware('auth');
Route::get('/admin/posts/{post}/edit',[PostController::class,'edit','post'])->name('post.edit')->middleware('can:update,post');
Route::patch('admin/posts/{postId}/update',[PostController::class,'update'])->name('post.update')->middleware('auth');
