<?php

declare(strict_types=1);

namespace App\Http\Validation\Exceptions;

final class InputDataBadFormatException extends BaseValidationException
{
    public function __construct(
        string $errorCode,
        int $statusCode,
        array|string $messages
    ) {
        parent::__construct(
            statusCode: $statusCode,
            errorCode: $errorCode,
            messages: $messages,
        );
    }
}
