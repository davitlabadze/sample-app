<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/products/all', '\App\Http\Controllers\ProductController@getAllProducts')
->name('products.all')
->middleware('auth');
Route::post('/products/save', '\App\Http\Controllers\ProductController@saveProducts')->name('products.save');
Route::post('/products/{id}/update', '\App\Http\Controllers\ProductController@updateProducts')->name('products.update');
Route::get('/products/{id}/edit', '\App\Http\Controllers\ProductController@editProducts')->name('products.edit');
Route::post('/products/{id}/delete', '\App\Http\Controllers\ProductController@deleteProducts')->name('products.delete');






Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('custom/register', [App\Http\Controllers\AuthorizationController::class, 'register'])->name('auth.custom.register');
Route::post('custom/login', [App\Http\Controllers\AuthorizationController::class, 'login'])->name('auth.custom.login');
Route::post('custom/logout', [App\Http\Controllers\AuthorizationController::class, 'logout'])->name('auth.custom.logout');

