<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\postController as ControllersPostController;
use App\Http\Controllers\userController;



Route::get('admin/users/me/profile/view',[userController::class,'show'])->name('user.me.profile')->middleware('auth');
Route::get('admin/users/me/profile/edit',[userController::class,'edit'])->name('user.profile.edit')->middleware('auth');
Route::patch('admin/users/me/updateProfile',[userController::class,'update'])->name('user.update')->middleware('auth');

//Route::get('admin/users/me/delete',[userController::class,'destroyMe'])->name('user.me.delete')->middleware('auth');

Route::delete('admin/users/{userId}/delete',[userController::class,'destroy','userId'])->name('user.delete')->middleware('auth');

Route::get('admin/users/{userId}/profile/assignRoles',[userController::class,'assignRoles','userId'])->name('users.profile.assignRoles')->middleware(['auth','role:admin']);
Route::patch('admin/users/{userId}/profile/attachRoles',[userController::class,'updateRolesAttach','userId','roles'])->name('user.attachRoles')->middleware(['auth','role:admin']);
Route::patch('admin/users/{userId}/profile/detachRoles',[userController::class,'updateRolesDetach','userId','detachRoles'])->name('user.detachRoles')->middleware(['auth','role:admin']);

Route::get('admin/users/{userId}/profile/view',[userController::class,'showAny'])->name('users.profiles.showAny')->middleware(['auth','role:admin']);
Route::get('admin/users/all',[userController::class,'index'])->name('users.all')->middleware(['auth','role:admin']);

Route::get('logout',function(){
 

    Auth::logout();
    return redirect('/');

});