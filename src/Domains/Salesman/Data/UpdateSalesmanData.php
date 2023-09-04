<?php

declare(strict_types=1);

namespace Domains\Salesman\Data;

use App\Data\BaseData;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Spatie\LaravelData\Optional;

final class UpdateSalesmanData extends BaseData
{
    public function __construct(
        public string|Optional $first_name,
        public string|Optional $last_name,
        public array|Optional|null $titles_before,
        public array|Optional|null $titles_after,
        public string|Optional $prosight_id,
        public string|Optional $email,
        public string|Optional $phone,
        public GenderEnum|Optional $gender,
        public MaritalStatusEnum|Optional $marital_status,
    ) {
    }
}
