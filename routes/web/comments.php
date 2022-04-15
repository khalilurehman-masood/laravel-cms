<?php

use App\Http\Controllers\commentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commentRepliesController;

Route::get('admin/comments/all',[commentController::class,'index'])->name('admin.comments.all')->middleware(['auth','role:admin']);
Route::delete('admin/comments/{commentId}/delete',[commentController::class,'destroy','commentId'])->name('comment.delete')->middleware(['auth','role:admin']);
Route::post('post/comments/{postId}/create',[commentController::class,'store','postId'])->name('comment.create');
Route::patch('post/comments/{postId}/changeStatus',[commentController::class,'changeStatus','commentId'])->name('comment.changeStatus');

