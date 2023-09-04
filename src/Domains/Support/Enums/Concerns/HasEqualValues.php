<?php

declare(strict_types=1);

namespace Domains\Support\Enums\Concerns;

trait HasEqualValues
{
    /**
     * @return array<string>
     */
    public function details(): array
    {
        $titles = self::cases();

        foreach ($titles as $title) {
            if ($this === $title) {
                return [
                    'code' => $title->value,
                    'name' => $title->value,
                ];
            }
        }

        return [];
    }
}
