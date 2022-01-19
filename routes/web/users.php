<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\UserController;

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('users.profile');

Route::middleware(['can:view,user'])->group(function () {
  Route::get('/profile/settings/{user}', [UpdateUserController::class, 'index'])->name('users.settings');
  Route::put('/profile/settings/{user}', [UpdateUserController::class, 'update'])->name('users.update');
});