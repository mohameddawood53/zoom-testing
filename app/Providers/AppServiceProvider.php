<?php

namespace App\Providers;

use App\Reposotiries\Meetings\Meeting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton("Meeting" , function ($app)
        {
            return new Meeting();
        });
    }
}
