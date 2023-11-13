<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', PageController::class)->name('index');

Auth::routes();

//Route::prefix('catalog')->group(function () {
    Route::resource('catalog', CatalogController::class)->parameters([
        'catalog' => 'slug'
    ]);
//    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
//});
Route::prefix('category')->group(function () {
    Route::resource('category', CategoryController::class)->parameters([
        'category' => 'slug'
    ]);
    Route::get('/', [CategoryController::class, 'indexPublic'])->name('categories.index');
    Route::get('show/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('update',[CartController::class, 'update'])->name('cart.update');
    Route::get('drop', [CartController::class, 'drop'])->name('cart.drop');
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('success/{orderId}', [CartController::class, 'success'])->name('cart.success');
});

Route::resource('order',OrderController::class, ['only' => ['store', 'update', 'destroy', 'show']]);

//Admin Panel
Route::group(['prefix' => 'admin-panel', 'middleware' => ['auth', 'admin-panel']], function () {
    Route::get('/', AdminController::class)->name('admin.index');

    //Users
    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('edit/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('admin.users.delete');
    });

    //Products
    Route::prefix('products')->group(function (){
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('create', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('edit/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('delete/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::get('drop/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('restore/{product}', [ProductController::class, 'restore'])->name('admin.products.restore');
    });

    //Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('show/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('delete/{order}', [OrderController::class, 'delete'])->name('admin.orders.delete');
        Route::get('drop/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
        Route::get('restore/{order}', [OrderController::class, 'restore'])->name('admin.orders.restore');
    });

    //Gallery
    Route::prefix('galleries')->group(function (){
        Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index');
    });
    //Gallery
    Route::prefix('categories')->group(function (){
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('create', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('edit/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('delete/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
        Route::get('drop/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::get('restore/{category}', [CategoryController::class, 'restore'])->name('admin.categories.restore');
    });
});

//01.03

//Route::prefix('admin-panel')->group(function (){
//    Route::get('/', [AdminController::class, 'index']);
//});

/*Route::get('/', function () {
    return view('layouts.app');
})->name('index');*/

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::group(['prefix' => 'users'],function (){
    Route::get('{id}/{username?}/{email?}', function ($id, $username = 'John', $email = "example@laravel-shop.local"){
        return 'Hello User ' . $id . '. Your name is ' . $username . '. Your email is ' . $email;
    })->name('users.show');
});*/

//Route::resource('users', UserController::class);
