<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Http\Validation\Factories\ValidationExceptionFactory;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

final class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(
            renderUsing: function (Throwable $exception): void {
                if ($exception instanceof ValidationException) {
                    throw ValidationExceptionFactory::make($exception->validator);
                }
            }
        );
    }
}
