<?php

declare(strict_types=1);

namespace App\Http\Validation\Enums;

use Symfony\Component\HttpFoundation\Response;

enum ValidationErrorTypeEnum: string
{
    case InputDataBadFormat = 'INPUT_DATA_BAD_FORMAT';
    case InputDataOutOfRange = 'INPUT_DATA_OUT_OF_RANGE';
    case PersonAlreadyExists = 'PERSON_ALREADY_EXISTS';

    public function statusCode(): int
    {
        return match ($this) {
            self::InputDataBadFormat => Response::HTTP_BAD_REQUEST,
            self::InputDataOutOfRange => Response::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE,
            self::PersonAlreadyExists => Response::HTTP_CONFLICT,
        };
    }
}
