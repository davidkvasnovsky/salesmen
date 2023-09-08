<?php

declare(strict_types=1);

namespace App\Http\Validation\Rules;

use Closure;
use Illuminate\Support\Str;

final class InputDataBadFormatRule extends HandlerAwareRule
{
    public bool $implicit = true;

    public function __construct(
        protected readonly array $allowedTypes,
        protected readonly ?array $args = null,
    ) {
        parent::__construct();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueForMessage = is_array($value) ? json_encode($value) : $value;
        $allowedTypesString = implode(', ', $this->allowedTypes);

        $message = Str::trimDoubleSpaces(
            "Bad format of input data. Field {$attribute} {$valueForMessage} must be of type {$allowedTypesString}."
        );

        foreach ($this->getHandlers() as $handler) {
            if ($handler->shouldFail($attribute, $value, $this->allowedTypes, $this->args)) {
                $fail($message);

                return;
            }
        }
    }
}
