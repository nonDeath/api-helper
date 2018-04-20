<?php
namespace Spys\ApiHelper;

use Illuminate\Support\ServiceProvider;

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
