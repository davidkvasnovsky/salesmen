<?php

declare(strict_types=1);

namespace Infrastructure\Salesman\Commands;

interface DestroySalesmanContract
{
    public function handle(string $id): ?bool;
}
