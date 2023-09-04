<?php

declare(strict_types=1);

namespace App\Http\Validation\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

final readonly class PersonAlreadyExistsRule implements ValidationRule
{
    public function __construct(
        private string $table,
        private string $object,
        private ?string $column = null,
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $column = $attribute;

        if ($this->column) {
            $column = $this->column;
        }

        $validator = Validator::make([$column => $value], [
            $attribute => "unique:{$this->table},{$column}",
        ]);

        if ($validator->fails()) {
            $fail("{$this->object} with such {$attribute} {$value} is already registered.");
        }
    }
}
