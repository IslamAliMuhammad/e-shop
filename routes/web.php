<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::redirect('/', '/home', 301);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){ //...

        // solve: Livewire + mcamara/laravel 404 not fount error
        Route::post('livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');

        Route::get('home', [HomeController::class, 'index'])->name('home');

        Route::get('about', function () {
            return view('client.about');
        })->name('about');

        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        Route::post('contact', [ContactController::class, 'sendEmail'])->middleware('verified');

        Route::resource('products', ProductController::class);

        Route::resource('cart_items', CartItemController::class);

        Route::post('wishlists/delete-all', [WishlistController::class, 'deleteAll'])->name('wishlists.deleteAll');
        Route::resource('wishlists', WishlistController::class);

        Route::middleware(['auth:sanctum', 'verified'])->group(function() {

            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');

            Route::resource('orders', OrderController::class);
        });

        Route::get('blog', [BlogController::class, 'index'])->name('blog');

        Route::resource('reviews', ReviewController::class)->only(['store']);


        Route::get('/auth/github/redirect', [GithubController::class, 'handleGithubRedirect']);
        Route::get('/auth/github/callback', [GithubController::class, 'handleGithubCallback']);

        Route::get('/search', [SearchController::class, 'getSearch'])->name('search');

    });

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
