<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BidController;

Route::middleware('auth')->group(function () {

  Route::get('/my-items', [ItemController::class, 'index'])->name('items.my-items');
  Route::get('/create', [ItemController::class, 'create'])->name('items.create');
  Route::post('/store', [ItemController::class, 'store'])->name('items.store');

  Route::get('/purchased', [ItemController::class, 'purchased'])->name('items.purchased');
  Route::get('/selled', [ItemController::class, 'selled'])->name('items.selled');

  Route::delete('/delete/{item}', [ItemController::class, 'destroy'])->name('items.delete');

  Route::get('/bids', [BidController::class, 'show'])->name('bids');
  Route::post('/bids/{item}', [BidController::class, 'store'])->name('bids.add');
  Route::delete('/bids/{bid}', [BidController::class, 'destroy'])->name('bids.delete');
});