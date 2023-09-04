<?php

declare(strict_types=1);

namespace App\Http\Validation\Rules;

use App\Http\Validation\Contracts\HandlesValidation;
use Closure;

abstract class HandlerAwareRule implements HandlesValidation
{
    private array $handlers;

    public function __construct()
    {
        $this->setHandlers();
    }

    public function getHandlers(): array
    {
        return $this->handlers;
    }

    private function setHandlers(): void
    {
        $this->handlers = array_map(
            fn ($handlerClass) => new $handlerClass,
            config(key: 'validation.handlers.' . static::class, default: [])
        );
    }

    abstract public function validate(string $attribute, mixed $value, Closure $fail): void;
}
