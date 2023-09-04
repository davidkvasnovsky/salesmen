<?php

declare(strict_types=1);

namespace App\Http\Validation\Handlers;

use App\Http\Validation\Contracts\ValidationHandlerContract;
use Illuminate\Support\Facades\Validator;

final class EmailValidationHandler implements ValidationHandlerContract
{
    public function shouldFail(string $attribute, mixed $value, array $allowedTypes, ?array $args): bool
    {
        if (!in_array('email', $allowedTypes)) {
            return false;
        }

        $validator = Validator::make([$attribute => $value], [
            $attribute => 'email:rfc,dns,spoof',
        ]);

        return $validator->fails();
    }
}
