<?php

namespace App\Providers;
use App\Models\Event;

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
        $latestEvent = Event::get()->last();
        
        \View::share('latestEvent', $latestEvent);
    }
}
