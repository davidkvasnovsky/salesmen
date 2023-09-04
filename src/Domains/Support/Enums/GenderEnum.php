<?php

declare(strict_types=1);

namespace Domains\Support\Enums;

use Domains\Support\Enums\Concerns\HasListableDetails;
use Domains\Support\Enums\Concerns\HasListableValues;
use Infrastructure\Support\Enums\BaseEnum;
use Infrastructure\Support\Enums\CodelistEnum;

enum GenderEnum: string implements BaseEnum, CodelistEnum
{
    use HasListableDetails;
    use HasListableValues;

    case Male = 'm';
    case Female = 'f';

    public function details(): array
    {
        return match ($this) {
            self::Male => [
                'code' => self::Male->value,
                'name' => 'muž'
            ],

            self::Female => [
                'code' => self::Female->value,
                'name' => 'žena'
            ],
        };
    }
}
