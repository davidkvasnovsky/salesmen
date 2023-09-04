<?php

declare(strict_types=1);

namespace App\Http\Validation\Handlers;

use App\Http\Validation\Contracts\ValidationHandlerContract;

final class TypeValidationHandler implements ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool
    {
        $valueType = gettype($value);

        return !in_array($valueType, $allowedTypes);
    }
}
