<?php

declare(strict_types=1);

namespace Domains\Salesman\Formatters;

final readonly class DisplayNameFormatter
{
    /**
     * @param string[]|null $titlesBefore
     * @param string[]|null $titlesAfter
     */
    public static function format(
        ?array $titlesBefore,
        ?array $titlesAfter,
        string $firstName,
        string $lastName
    ): string {
        $formattedTitlesBefore = implode(' ', $titlesBefore ?? []);
        $formattedTitlesAfter = implode(' ', $titlesAfter ?? []);

        $displayName = trim("{$formattedTitlesBefore} {$firstName} {$lastName}");

        if (!empty($formattedTitlesAfter)) {
            $displayName .= ", {$formattedTitlesAfter}";
        }

        return $displayName;
    }
}
