<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

final class ValidateSignature extends Middleware
{
    /** @var string[] */
    protected array $except = [];
}
