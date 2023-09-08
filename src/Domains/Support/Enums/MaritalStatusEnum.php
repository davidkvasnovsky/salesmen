<?php

declare(strict_types=1);

namespace Domains\Support\Enums;

use Domains\Support\Enums\Concerns\HasListableDetails;
use Domains\Support\Enums\Concerns\HasListableValues;
use Infrastructure\Support\Enums\BaseEnum;
use Infrastructure\Support\Enums\CodelistEnum;

enum MaritalStatusEnum: string implements BaseEnum, CodelistEnum
{
    use HasListableDetails;
    use HasListableValues;

    case Single = 'single';
    case Married = 'married';
    case Divorced = 'divorced';
    case Widowed = 'widowed';

    public function details(): array
    {
        return match ($this) {
            self::Single => [
                'code' => self::Single,
                'name' => [
                    GenderEnum::Male->value => 'slobodný',
                    GenderEnum::Female->value => 'slobodná',
                    'general' => 'slobodný / slobodná',
                ],
            ],

            self::Married => [
                'code' => self::Married,
                'name' => [
                    GenderEnum::Male->value => 'ženatý',
                    GenderEnum::Female->value => 'vydatá',
                    'general' => 'ženatý / vydatá',
                ],
            ],

            self::Divorced => [
                'code' => self::Divorced,
                'name' => [
                    GenderEnum::Male->value => 'rozvedený',
                    GenderEnum::Female->value => 'rozvedená',
                    'general' => 'rozvedený / rozvedená',
                ],
            ],

            self::Widowed => [
                'code' => self::Widowed,
                'name' => [
                    GenderEnum::Male->value => 'vdovec',
                    GenderEnum::Female->value => 'vdova',
                    'general' => 'vdovec / vdova',
                ],
            ],
        };
    }
}
