<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FilterController;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/{product}', [ProductController::class, 'getProduct']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/subcategories/{categoryId}', [SubCategoryController::class, 'getSubcategoriesByCategory']);
Route::get('/slides', [SlideController::class, 'getSlides']);
Route::post('/products/filter', [ProductController::class, 'filter']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/categories/{id}/products', [ProductController::class, 'getProductsByCategory']);
Route::get('/subcategories/{id}/products', [ProductController::class, 'getProductsBySubCategory']);
Route::get('/filters/color', [FilterController::class, 'filtersForColor']);


Route::get('/test', function () {
    return 'API is working';
});



