<?php

declare(strict_types=1);

namespace App\Http\Validation\Contracts;

interface ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool;
}
