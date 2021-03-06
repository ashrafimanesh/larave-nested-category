<?php

namespace Ashrafi\NestedCategories;

use Illuminate\Support\ServiceProvider;

class NestedCategoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'NestedCategories');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Ashrafi\NestedCategories\NestedCategoriesController');
    }

}
