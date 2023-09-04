<?php

declare(strict_types=1);

namespace App\Providers;

use Domains\Salesman\Providers\BindingServiceProvider as SalesmanServiceProvider;
use Illuminate\Support\ServiceProvider;

final class BindingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            provider: SalesmanServiceProvider::class,
        );
    }
}
