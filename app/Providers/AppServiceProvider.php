<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Organization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        if(!app()->runningInConsole() ) {

            $org = Organization::whereNull('registration_no')
                ->where('is_declined', false)
                ->where('is_submitted', true)
                ->count();

            view()->share('unregistered_registration_no', $org);

//        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
