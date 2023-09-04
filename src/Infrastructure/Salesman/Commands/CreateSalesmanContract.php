<?php

declare(strict_types=1);

namespace Infrastructure\Salesman\Commands;

use Domains\Salesman\Data\CreateSalesmanData;
use Domains\Salesman\Models\Salesman;

interface CreateSalesmanContract
{
    public function handle(CreateSalesmanData $payload): Salesman;
}
