<?php

declare(strict_types=1);

namespace Domains\Salesman\Data;

use App\Data\BaseData;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Infrastructure\Support\Data\CreatableFromCsv;

final class CreateSalesmanData extends BaseData implements CreatableFromCsv
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?array $titles_before,
        public ?array $titles_after,
        public string $prosight_id,
        public string $email,
        public ?string $phone,
        public GenderEnum $gender,
        public ?MaritalStatusEnum $marital_status,
    ) {
    }

    public static function fromCsv(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            titles_before: $data['titles_before'] ? explode(',', $data['titles_before']) : null,
            titles_after: $data['titles_after'] ? explode(',', $data['titles_after']) : null,
            prosight_id: $data['prosight_id'],
            email: $data['email'],
            phone: $data['phone'],
            gender: GenderEnum::from($data['gender']),
            marital_status: MaritalStatusEnum::from($data['marital_status']),
        );
    }
}
