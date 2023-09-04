<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Concerns\HasCsvSeed;
use Domains\Salesman\Data\CreateSalesmanData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Database\Seeder;

final class SalesmanSeeder extends Seeder
{
    use HasCsvSeed;

    public function run(): void
    {
        $this->seedFromCsv(
            dataClass: CreateSalesmanData::class,
            modelClass: Salesman::class,
            fileName: 'salesmen.csv',
        );
    }
}
