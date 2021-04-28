<?php
namespace ND\ApiHelper;

use Illuminate\Support\ServiceProvider;

/**
 * Class ApiHelperServiceProvider
 * @package Spys\ApiHelper
 */
class ApiHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'../resources/lang', 'api-helper');


        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/api-helper'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
