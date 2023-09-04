<?php

declare(strict_types=1);

namespace App\Http\Validation\Handlers;

use App\Http\Validation\Contracts\ValidationHandlerContract;
use Illuminate\Validation\Rules\Enum;
use RuntimeException;

final class EnumValidationHandler implements ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool
    {
        if (!in_array('enum', $allowedTypes)) {
            return false;
        }

        $enum = $args['enum'] ?? throw new RuntimeException("Enum must be set when 'enum' is in allowedTypes.");

        $enumRule = new Enum($enum);

        return is_array($value)
            ? !empty(array_filter($value, fn ($case) => !$enumRule->passes($attribute, $case)))
            : !$enumRule->passes($attribute, $value);
    }
}
