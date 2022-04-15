<?php

use App\Http\Controllers\categoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('admin/categories',[categoryController::class,'index'])->name('categories')->middleware(['auth','role:admin']);
Route::post('admin/categories/create',[categoryController::class,'store'])->name('categories.create')->middleware(['auth','role:admin']);
Route::delete('admin/categories/delete',[categoryController::class,'destroy'])->name('categories.delete')->middleware(['auth','role:admin']);


Route::get('categories/{categoryId}/show',[categoryController::class,'show','categoryId'])->name('category.showPosts');
