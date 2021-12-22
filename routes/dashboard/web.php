<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
            Route::get('/', function () {
                return view('dashboard.layouts/app');
            })->name('home.index');

            Route::resource('users', UserController::class);

            Route::resource('categories', CategoryController::class);

            Route::resource('subcategories', SubcategoryController::class);

            Route::resource('brands', BrandController::class);

            Route::resource('discounts', DiscountController::class);

            Route::resource('products', ProductController::class);

            Route::resource('products.variations', Product\VariationController::class);

        });
    });
