<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientAuthController;


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::get('/subcategories/{categoryId}', [SubCategoryController::class, 'getSubcategoriesByCategory']);
Route::get('/subcategories', [SubCategoryController::class, 'getSubcategories']);

Route::get('/slides', [SlideController::class, 'getSlides']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orderss', [OrderController::class, 'getOrders']);
Route::get('/orders/{id}/status', [OrderController::class, 'getOrderStatus']);

Route::get('/filters/color', [FilterController::class, 'filtersForColor']);

Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/products/categories/{id}', [ProductController::class, 'getProductsByCategory']);
Route::get('/products/subcategories/{id}', [ProductController::class, 'getProductsBySubCategory']);
Route::get('/product/{id}', [ProductController::class, 'showProductById']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::post('/products/filter', [ProductController::class, 'filter']);

Route::post('/contact', [ContactController::class, 'sendEmail']);


Route::prefix('auth')->group(function () {
    Route::post('/register', [ClientAuthController::class, 'register']);
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::put('/update', [ClientAuthController::class, 'update']);
    Route::middleware('auth:sanctum')->post('/logout', [ClientAuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->get('/user', [ClientAuthController::class, 'user']);
});



Route::get('/test', function () {
    return 'API is working';
});



