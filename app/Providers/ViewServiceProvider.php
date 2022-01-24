<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ShoppingSession;
use App\Traits\ShoppingSessionTrait;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    use ShoppingSessionTrait;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        View::composer('client.layouts.partials._header', function ($view) {
            //
            $shoppingSession = $this->getShoppingSession();

            $cartItemsCount = $shoppingSession->cartItems()->count();

            $view
                ->with('cartItemsCount', $cartItemsCount);

        });

        View::composer(['client.layouts.partials._footer'], function ($view) {
            //
            $categories = Category::withTranslation()->get();
            $view
                ->with('categories', $categories);
        });
    }
}
