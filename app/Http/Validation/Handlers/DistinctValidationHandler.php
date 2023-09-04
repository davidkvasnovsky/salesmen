<?php

declare(strict_types=1);

namespace App\Http\Validation\Handlers;

use App\Http\Validation\Contracts\ValidationHandlerContract;

final class DistinctValidationHandler implements ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool
    {
        if (!in_array('distinct', $allowedTypes)) {
            return false;
        }

        if (!is_array($value)) {
            return false;
        }

        return count(array_unique($value)) !== count($value);
    }
}
