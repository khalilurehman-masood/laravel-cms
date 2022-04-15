<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commentRepliesController;

Route::get('admin/replies/all',[commentRepliesController::class,'index'])->name('admin.replies.all')->middleware(['auth','role:admin']);
Route::post('comments/reply',[commentRepliesController::class,'store'])->name('comment.reply')->middleware('auth');
Route::delete('admin/reply/{replyId}/delete',[commentRepliesController::class,'destroy','replyId'])->name('reply.delete')->middleware('auth');
Route::patch('comment/reply/edit',[commentRepliesController::class,'update'])->name('comment.reply.edit')->middleware('auth');

// Route::post('post/comments/{postId}/create',[commentController::class,'store','postId'])->name('comment.create');
// Route::patch('post/comments/{postId}/changeStatus',[commentController::class,'changeStatus','commentId'])->name('comment.changeStatus');

Route::get('admin/myReplies',[commentRepliesController::class,'myReplies'])->name('admin.myReplies')->middleware(['auth']);
