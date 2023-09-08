<?php

declare(strict_types=1);

namespace App\Http\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

final class InputDataOutOfRangeRule implements ValidationRule
{
    public bool $implicit = true;

    public function __construct(
        protected readonly int $min,
        protected readonly int $max
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = Validator::make([$attribute => $value], [
            $attribute => "between:{$this->min},{$this->max}",
        ]);

        if (is_array($value)) {
            $value = json_encode($value);
        }

        if ($validator->fails()) {
            $fail(
                Str::trimDoubleSpaces(
                    "Input data out of range. Field {$attribute} of value {$value} is out of range. Acceptable range for this field is {$this->min} to {$this->max}."
                )
            );
        }
    }
}
