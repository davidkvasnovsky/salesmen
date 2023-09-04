<?php

declare(strict_types=1);

namespace Domains\Support\Enums\Concerns;

trait HasListableValues
{
    public static function values(): array
    {
        return array_column(
            array: self::cases(),
            column_key: 'value'
        );
    }
}
