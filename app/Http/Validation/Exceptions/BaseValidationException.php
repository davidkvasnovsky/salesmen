<?php

declare(strict_types=1);

namespace App\Http\Validation\Exceptions;

use App\Http\Validation\Responses\ValidationErrorResponse;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class BaseValidationException extends HttpException implements Renderable
{
    public function __construct(
        protected int $statusCode,
        protected string $errorCode,
        protected array|string $messages
    ) {
        $this->messages = is_array($this->messages) ? $this->messages : [$this->messages];

        parent::__construct(
            statusCode: $statusCode,
        );
    }

    public function render(): ValidationErrorResponse
    {
        return new ValidationErrorResponse(
            statusCode: $this->statusCode,
            errorCode: $this->errorCode,
            messages: $this->messages
        );
    }
}
