<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PageController;
use App\Models\Category;




Route::name('front.')->group(function (){
    Route::get('/', [PageController::class , 'home'])->name('index');
    Route::get('/post/{slug}', [PageController::class , 'singlePost'])->name('post');
    Route::get('/category/{slug}', [PageController::class , 'singleCategory'])->name('category');

});






Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {

    Route::resource('/category', CategoryController::class)->except('show', 'create');
    Route::resource('/config', ConfigController::class)->except('show', 'create');

    Route::resource('/post', PostController::class)->except('show');

//or

//     Route::prefix('category')->name('category.')->group(function () {
//         Route::get('/', [CategoryController::class, 'index'])->name('index');
//         Route::post('/store', [CategoryController::class, 'store'])->name('store');
//         Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
//         Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
//         Route::post('/{id}/update', [CategoryController::class, 'update'])->name('update');  
//     });
    
});






Route::get('/products/all', '\App\Http\Controllers\ProductController@getAllProducts')->name('products.all')->middleware('auth');
Route::post('/products/save', '\App\Http\Controllers\ProductController@saveProducts')->name('products.save');
Route::post('/products/{id}/update', '\App\Http\Controllers\ProductController@updateProducts')->name('products.update');
Route::get('/products/{id}/edit', '\App\Http\Controllers\ProductController@editProducts')->name('products.edit');
Route::post('/products/{id}/delete', '\App\Http\Controllers\ProductController@deleteProducts')->name('products.delete');






Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('custom/register', [App\Http\Controllers\AuthorizationController::class, 'register'])->name('auth.custom.register');
Route::post('custom/login', [App\Http\Controllers\AuthorizationController::class, 'login'])->name('auth.custom.login');
Route::post('custom/logout', [App\Http\Controllers\AuthorizationController::class, 'logout'])->name('auth.custom.logout');


Route::get('testlayouts', function () {
    return view('layouts.main');
});

