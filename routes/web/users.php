<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\UserController;


Route::middleware(['auth'])->group(function () {
  Route::get('/profile/{user}', [UpdateUserController::class, 'index'])->name('users.profile');
  Route::put('/profile/{user}', [UpdateUserController::class, 'update'])->name('users.update');
  Route::get('/settings', [UserController::class, 'settings'])->name('users.settings');
});