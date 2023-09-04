<?php

declare(strict_types=1);

namespace Domains\Salesman\Commands;

use Domains\Salesman\Data\UpdateSalesmanData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Support\Facades\DB;
use Infrastructure\Salesman\Commands\UpdateSalesmanContract;

final class UpdateSalesman implements UpdateSalesmanContract
{
    public function handle(UpdateSalesmanData $payload, string $id): Salesman
    {
        return DB::transaction(
            callback: fn () => tap(Salesman::findOrFail($id))
                ->update($payload->toArray())
        );
    }
}
