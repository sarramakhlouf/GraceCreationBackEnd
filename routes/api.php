<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SlideController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** Products & categories*/
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/sub-categories', [SubCategoryController::class, 'index']);
Route::get('/slides', [SlideController::class, 'index']);

Route::get('/test', function () {
    return 'API is working';
});



