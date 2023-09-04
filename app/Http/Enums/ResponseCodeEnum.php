<?php

declare(strict_types=1);

namespace App\Http\Enums;

enum ResponseCodeEnum: int
{
    case FORBIDDEN = 400;
    case INPUT_DATA_BAD_FORMAT = 422;
    case BAD_REQUEST = 403;
    case PERSON_NOT_FOUND = 404;
}
