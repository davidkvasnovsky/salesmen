<?php

declare(strict_types=1);

namespace Infrastructure\Support\Enums;

use Illuminate\Support\Collection;

interface CodelistEnum
{
    public static function all(): Collection;

    public function details(): array;
}
