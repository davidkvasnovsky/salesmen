<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\Facades\Route;

use function strval;

final class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for(
            name: 'api',
            callback: static fn (Request $request): Limit => Limit::perMinute(
                maxAttempts: 60,
            )->by(
                key: strval(Auth::id() ?? $request->ip()),
            ),
        );

        $this->routes(static function (): void {
            Route::middleware('api')->group(
                base_path('routes/api.php')
            );
        });
    }
}
