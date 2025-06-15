<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KitchenTaskController;

Route::get('/', function () {
    return view('pages.homepage');
});

Route::apiResource('order-details', KitchenTaskController::class);
// Tambahan khusus: filter berdasarkan chef
Route::get('order-details/chef/{chef}', [KitchenTaskController::class, 'getByChef']);
