<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KitchenTaskController;

Route::get('/', function () {
    return view('pages.homepage');
});


Route::apiResource('kitchen-tasks', KitchenTaskController::class);
