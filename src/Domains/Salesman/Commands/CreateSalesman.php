<?php

declare(strict_types=1);

namespace Domains\Salesman\Commands;

use Domains\Salesman\Data\CreateSalesmanData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Support\Facades\DB;
use Infrastructure\Salesman\Commands\CreateSalesmanContract;

final class CreateSalesman implements CreateSalesmanContract
{
    public function handle(CreateSalesmanData $payload): Salesman
    {
        return DB::transaction(
            callback: fn () => Salesman::create(
                $payload->toArray()
            ),
        );
    }
}
