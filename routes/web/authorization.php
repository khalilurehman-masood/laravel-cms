<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\roleMiddleWare;
use Illuminate\Support\Facades\Route;

Route::get('/roles',[RoleController::class,'index'])->name('authorization.roles')->middleware(['auth','role:admin']);
Route::get('/permissions',[PermissionController::class,'index'])->name('authorization.permissions')->middleware(['auth','role:admin']);

Route::post('/roles/create',[RoleController::class,'store'])->name('roles.create')->middleware(['auth','role:admin']);
Route::delete('/roles/delete',[RoleController::class,'delete'])->name('roles.delete')->middleware(['auth','role:admin']);