<?php

declare(strict_types=1);

namespace Domains\Support\Enums\Concerns;

use Illuminate\Support\Collection;

trait HasListableDetails
{
    public static function all(): Collection
    {
        return collect(self::cases())->map(
            fn(self $case) => $case->details()
        );
    }
}
