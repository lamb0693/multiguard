<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyGlobalFunctionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once base_path().'/app/MyFunctions/GlobalFunction.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
