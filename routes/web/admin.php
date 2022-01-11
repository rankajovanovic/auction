<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\RoleController;

Route::middleware(['role:admin', 'auth'])->group(function () {
  Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
  Route::get('/users', [UserController::class, 'index'])->name('admin.users');
  Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');
  Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
  Route::post('/categories', [CategoryController::class, 'store'])->name('admin.add.category');
  Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.delete.category');
  Route::get('/items', [AdminController::class, 'getItems'])->name('admin.items');
  Route::get('/bids', [BidController::class, 'index'])->name('admin.bids');

  Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
  Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.create');
  Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

  Route::put('/users/{user}/attach', [AdminController::class, 'attach'])->name('admin.users.role.attach');
  Route::put('/users/{user}/detach', [AdminController::class, 'detach'])->name('admin.users.role.detach');
});