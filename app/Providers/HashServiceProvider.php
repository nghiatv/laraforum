<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    protected $defer = true;
    public function register()
    {
        //
        $this->app->singleton('hash',function(){
            return 0;
        });
    }
    public function provides()
    {
        return ['hash'];
    }
}
