<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('hasRole', function($expression){
            $user = optional(auth()->user());
            if ($user->hasRole($expression)) {
                return true;
            }
            return false;
        });
    }
}
