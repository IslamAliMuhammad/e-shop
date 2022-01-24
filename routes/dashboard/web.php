<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Product\VariationController;

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

            Route::get('/', [HomeController::class, 'index'])->name('home.index');

            Route::resource('users', UserController::class);

            Route::resource('categories', CategoryController::class);

            Route::resource('subcategories', SubcategoryController::class);

            Route::resource('brands', BrandController::class);

            Route::resource('discounts', DiscountController::class);

            Route::resource('products', ProductController::class);

            Route::get('/products/{product}/variations/visual', [VariationController::class, 'visual'])->name('products.variations.visual');

            Route::resource('products.variations', Product\VariationController::class);

            Route::resource('orders', OrderController::class);


            Route::resource('orders.order_items', Order\OrderItemController::class);


            Route::resource('coupons', CouponController::class);

        });
    });
