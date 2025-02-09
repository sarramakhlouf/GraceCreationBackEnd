<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\TypeFilterController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProductFilterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/produits', [ProductController::class, 'index'])->name('produits.index'); // Liste des produits
    Route::get('/produits/create', [ProductController::class, 'create'])->name('produits.create'); // Formulaire de création
    Route::post('/produits', [ProductController::class, 'store'])->name('produits.store'); // Enregistrement d'un nouveau produit
    Route::get('/produits/{product}/edit', [ProductController::class, 'edit'])->name('produits.edit'); // Formulaire d'édition
    Route::put('/produits/{product}', [ProductController::class, 'update'])->name('produits.update'); // Mise à jour du produit
    Route::delete('/produits/{product}', [ProductController::class, 'destroy'])->name('produits.destroy'); // Suppression d'un produit
});



Route::middleware('auth')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{subCategory}', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/subcategories/{subCategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{subCategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/slides', [SlideController::class, 'index'])->name('slides.index');
    Route::get('/slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::post('/slides', [SlideController::class, 'store'])->name('slides.store');
    Route::get('/slides/{slide}', [SlideController::class, 'edit'])->name('slides.edit');
    Route::put('/slides/{slide}', [SlideController::class, 'update'])->name('slides.update');
    Route::delete('/slides/{slide}', [SlideController::class, 'destroy'])->name('slides.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/commandes', [OrderController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/create', [OrderController::class, 'create'])->name('commandes.create');
    Route::post('/commandes', [OrderController::class, 'store'])->name('commandes.store');
    Route::get('/commandes/{commande}', [OrderController::class, 'edit'])->name('commandes.edit');
    Route::put('/commandes/{commande}', [OrderController::class, 'update'])->name('commandes.update');
    Route::delete('/commandes/{commande}', [OrderController::class, 'destroy'])->name('commandes.destroy');
    Route::post('/commandes/{id}/validate', [OrderController::class, 'validateOrder'])->name('commandes.validate');
    Route::post('/commandes/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('commandes.cancel');
    Route::get('/commandes/{id}/validate', [OrderController::class, 'validateOrder'])->name('commandes.validate');
});

Route::middleware('auth')->group(function () {
    Route::get('/depots', [DepotController::class, 'index'])->name('depots.index');
    Route::get('/depots/create', [DepotController::class, 'create'])->name('depots.create');
    Route::post('/depots', [DepotController::class, 'store'])->name('depots.store');
    Route::get('/depots/{depot}', [DepotController::class, 'edit'])->name('depots.edit');
    Route::put('/depots/{depot}', [DepotController::class, 'update'])->name('depots.update');
    Route::delete('/depots/{depot}', [DepotController::class, 'destroy'])->name('depots.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::get('/inventories/{inventory}', [InventoryController::class, 'edit'])->name('inventories.edit');
    Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/types', [TypeFilterController::class, 'index'])->name('typefilter.index');
    Route::get('/types/create', [TypeFilterController::class, 'create'])->name('typefilter.create');
    Route::post('/types', [TypeFilterController::class, 'store'])->name('typefilter.store');
    Route::get('/types/{typefilter}', [TypeFilterController::class, 'edit'])->name('typefilter.edit');
    Route::put('/types/{typefilter}', [TypeFilterController::class, 'update'])->name('typefilter.update');
    Route::delete('/types/{typefilter}', [TypeFilterController::class, 'destroy'])->name('typefilter.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/filters', [FilterController::class, 'index'])->name('filters.index');
    Route::get('/filters/create', [FilterController::class, 'create'])->name('filters.create');
    Route::post('/filters', [FilterController::class, 'store'])->name('filters.store');
    Route::get('/filters/{filter}', [FilterController::class, 'edit'])->name('filters.edit');
    Route::put('/filters/{filter}', [FilterController::class, 'update'])->name('filters.update');
    Route::delete('/filters/{filter}', [FilterController::class, 'destroy'])->name('filters.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/relationproductfilters', [ProductFilterController::class, 'index'])->name('productfilters.index');
    Route::get('/relationproductfilters/create', [ProductFilterController::class, 'create'])->name('productfilters.create');
    Route::post('/relationproductfilters', [ProductFilterController::class, 'store'])->name('productfilters.store');
    Route::delete('/relationproductfilters/{product_id}/{filter_id}', [ProductFilterController::class, 'destroy'])->name('productfilters.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});




require __DIR__.'/auth.php';
