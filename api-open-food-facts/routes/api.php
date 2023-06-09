<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::put('/products/{code}', [ProductController::class, 'update']);
Route::delete('/products/{code}', [ProductController::class, 'destroy']);
Route::get('/products/{code}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/', [ProductController::class, 'showList']);
