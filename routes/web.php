<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('category')->group(function () {
        Route::get('index'      , [ App\Http\Controllers\Category\CategoryController::class, 'index'    ])->name('index-category');
        Route::get('add'        , [ App\Http\Controllers\Category\CategoryController::class, 'add'      ])->name('add-category');
        Route::post('add'       , [ App\Http\Controllers\Category\CategoryController::class, 'store'    ])->name('add-category');
        Route::get('edit/{id}'  , [ App\Http\Controllers\Category\CategoryController::class, 'edit'     ])->name('edit-category');
        Route::post('edit/{id}' , [ App\Http\Controllers\Category\CategoryController::class, 'update'   ])->name('update-category');
        Route::get('delete/{id}', [ App\Http\Controllers\Category\CategoryController::class, 'delete'   ])->name('delete-category');
    });

    Route::prefix('product')->group(function () {
        Route::get('index'      , [ App\Http\Controllers\Product\ProductController::class, 'index'  ])->name('index-product');
        Route::get('add'        , [ App\Http\Controllers\Product\ProductController::class, 'add'    ])->name('add-product');
        Route::post('add'       , [ App\Http\Controllers\Product\ProductController::class, 'store'  ])->name('add-product');
        Route::get('edit/{id}'  , [ App\Http\Controllers\Product\ProductController::class, 'edit'   ])->name('edit-product');
        Route::post('edit/{id}' , [ App\Http\Controllers\Product\ProductController::class, 'update' ])->name('update-product');
        Route::get('delete/{id}', [ App\Http\Controllers\Product\ProductController::class, 'delete' ])->name('delete-product');
    });

});

// 

