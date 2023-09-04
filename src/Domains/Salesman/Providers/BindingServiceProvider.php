<?php

declare(strict_types=1);

namespace Domains\Salesman\Providers;

use Domains\Salesman\Commands\CreateSalesman;
use Domains\Salesman\Commands\DestroySalesman;
use Domains\Salesman\Commands\UpdateSalesman;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Salesman\Commands\CreateSalesmanContract;
use Infrastructure\Salesman\Commands\DestroySalesmanContract;
use Infrastructure\Salesman\Commands\UpdateSalesmanContract;

final class BindingServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides(): array
    {
        return [
            CreateSalesmanContract::class,
            UpdateSalesmanContract::class,
            DestroySalesmanContract::class,
        ];
    }

    public function register(): void
    {
        $this->app->bind(
            abstract: CreateSalesmanContract::class,
            concrete: CreateSalesman::class,
        );

        $this->app->bind(
            abstract: UpdateSalesmanContract::class,
            concrete: UpdateSalesman::class,
        );

        $this->app->bind(
            abstract: DestroySalesmanContract::class,
            concrete: DestroySalesman::class,
        );
    }
}
