<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\UpdateUserController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/items/single/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/category/{category}', [HomeController::class, 'show'])->name('items.category');

Route::middleware('auth')->group(function () {
  Route::get('/admin', [AdminController::class, 'index'])->name('admin');

  Route::post('/items', [ItemController::class, 'store'])->name('items.store');
  Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
  Route::get('/items/my-items', [ItemController::class, 'index'])->name('items.my-items');
  Route::get('/items/purchased', [ItemController::class, 'purchased'])->name('items.purchased');
  Route::delete('/items/delete/{item}', [ItemController::class, 'destroy'])->name('items.delete');

  Route::get('/bids', [BidController::class, 'show'])->name('bids');
  Route::post('/bids/{item}', [BidController::class, 'store'])->name('bids.add');
  Route::delete('/bids/{bid}', [BidController::class, 'destroy'])->name('bids.delete');
});