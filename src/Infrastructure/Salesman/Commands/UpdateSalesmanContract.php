<?php

declare(strict_types=1);

namespace Infrastructure\Salesman\Commands;

use Domains\Salesman\Data\UpdateSalesmanData;
use Domains\Salesman\Models\Salesman;

interface UpdateSalesmanContract
{
    public function handle(UpdateSalesmanData $payload, string $id): Salesman;
}
