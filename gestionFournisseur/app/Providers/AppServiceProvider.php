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
        Blade::directive('role', function ($expression) {
            $roles = explode(',', str_replace(['[', ']'], '', $expression));
        
            $roleChecks = [];
            foreach ($roles as $role) {
                $roleChecks[] = "Auth::guard('responsables')->user()->role === " . trim($role);
            }
        
            $roleExpression = implode(' || ', $roleChecks);
        
            return "<?php if (Auth::guard('responsables')->check() && ($roleExpression)): ?>";
        });
        
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
