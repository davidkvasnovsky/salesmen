<?php

declare(strict_types=1);

namespace Domains\Salesman\Data;

use App\Data\BaseData;
use Carbon\CarbonImmutable;
use Domains\Salesman\Formatters\DisplayNameFormatter;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Spatie\LaravelData\Attributes\Computed;

final class SalesmanResourceData extends BaseData
{
    #[Computed]
    public string $display_name;
    public string $self;

    public function __construct(
        public string $id,
        public string $first_name,
        public string $last_name,
        public ?array $titles_before,
        public ?array $titles_after,
        public string $prosight_id,
        public string $email,
        public ?string $phone,
        public GenderEnum $gender,
        public ?MaritalStatusEnum $marital_status,
        public CarbonImmutable $created_at,
        public CarbonImmutable $updated_at,
    ) {
        $this->display_name = DisplayNameFormatter::format(
            titlesBefore: $this->titles_before,
            titlesAfter: $this->titles_after,
            firstName: $this->first_name,
            lastName: $this->last_name,
        );

        $this->self = "/self/{$this->id}";
    }
}
