<?php

declare(strict_types=1);

namespace Domains\Support\Data;

use App\Data\BaseData;
use Illuminate\Support\Collection;

final class CodelistResourceData extends BaseData
{
    public function __construct(
        public Collection $marital_statuses,
        public Collection $genders,
        public Collection $titles_before,
        public Collection $titles_after,
    ) {
    }
}
