<?php

declare(strict_types=1);

namespace App\Http\Validation\Contracts;

use Illuminate\Contracts\Validation\ValidationRule;

interface HandlesValidation extends ValidationRule
{
    public function getHandlers(): array;
}
