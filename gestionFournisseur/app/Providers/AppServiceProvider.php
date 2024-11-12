<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
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
        Blade::directive('role', function ($role) {
            // Wrap the role in single quotes to ensure it’s interpreted as a string
            return "<?php if (Auth::guard('responsables')->check() && Auth::guard('responsables')->user()->role === {$role}): ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
