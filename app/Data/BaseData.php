<?php

declare(strict_types=1);

namespace App\Data;

use App\Data\Collections\PaginatedDataCollection;
use Spatie\LaravelData\Data;

abstract class BaseData extends Data
{
    protected static string $_paginatedCollectionClass = PaginatedDataCollection::class;
}
