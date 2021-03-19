<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\HelpClass\Animals;
use function foo\func;

class AnimalProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('animal', function () {
            return new Animals();
        });
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
