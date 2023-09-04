<?php

declare(strict_types=1);

namespace Domains\Salesman\Commands;

use Domains\Salesman\Models\Salesman;
use Illuminate\Support\Facades\DB;
use Infrastructure\Salesman\Commands\DestroySalesmanContract;

final class DestroySalesman implements DestroySalesmanContract
{
    public function handle(string $id): bool
    {
        return DB::transaction(
            callback: fn () => Salesman::findOrFail($id)->delete()
        );
    }
}
