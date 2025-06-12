<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderDetailController;

Route::get('/', function () {
    return view('pages.homepage');
});


Route::apiResource('order-details', OrderDetailController::class);
