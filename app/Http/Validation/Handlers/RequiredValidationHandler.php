<?php

declare(strict_types=1);

namespace App\Http\Validation\Handlers;

use App\Http\Validation\Contracts\ValidationHandlerContract;
use Illuminate\Support\Facades\Validator;

final class RequiredValidationHandler implements ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool
    {
        if (!in_array('required', $allowedTypes)) {
            return false;
        }

        $validator = Validator::make([$attribute => $value], [
            $attribute => 'required',
        ]);

        return $validator->fails();
    }
}
