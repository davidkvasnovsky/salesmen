<?php

declare(strict_types=1);

namespace App\Http\Validation\Rules;

use Closure;

final class InputDataBadFormatRule extends HandlerAwareRule
{
    public function __construct(
        protected array $allowedTypes,
        protected ?array $args = null,
    ) {
        parent::__construct();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueForMessage = is_array($value) ? json_encode($value) : $value;
        $allowedTypesString = implode(', ', $this->allowedTypes);

        $message = "Bad format of input data. Field {$attribute} {$valueForMessage} must be of type {$allowedTypesString}.";

        foreach ($this->getHandlers() as $handler) {
            if ($handler->shouldFail($attribute, $value, $this->allowedTypes, $this->args)) {
                $fail($message);

                return;
            }
        }
    }
}
