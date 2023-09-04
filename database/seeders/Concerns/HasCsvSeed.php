<?php

declare(strict_types=1);

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\File;

trait HasCsvSeed
{
    public function seedFromCsv(string $dataClass, string $modelClass, string $fileName): void
    {
        $filePath = $this->getCsvFilePath($fileName);

        if (!$this->isValidFile($filePath)) {
            return;
        }

        [$headers, $rows] = $this->parseCsvFile($filePath);

        if (empty($headers) || empty($rows)) {
            return;
        }

        $this->processRows($dataClass, $modelClass, $headers, $rows);
    }

    private function getCsvFilePath(string $fileName): string
    {
        return storage_path("database/seeders/{$fileName}");
    }

    private function isValidFile(string $filePath): bool
    {
        if (!File::exists($filePath)) {
            $this->command->error("CSV file does not exist: {$filePath}");

            return false;
        }

        return true;
    }

    private function parseCsvFile(string $filePath): array
    {
        $csvData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (empty($csvData)) {
            $this->command->error("CSV file is empty: {$filePath}");
            return [[], []];
        }

        $headers = str_getcsv(array_shift($csvData));
        $rows = array_map('str_getcsv', $csvData);

        return [$headers, $rows];
    }

    private function processRows(string $dataClass, string $modelClass, array $headers, array $rows): void
    {
        foreach ($rows as $row) {
            if (!$this->isValidRow($headers, $row)) {
                continue;
            }

            $combinedData = array_combine($headers, $row);
            $validatedData = $dataClass::validateAndCreate($dataClass::fromCsv($combinedData));

            $model = $modelClass::create($validatedData->toArray());
        }

        $this->command->info("CSV seeding completed for {$model->getTable()}");
    }

    private function isValidRow(array $headers, array $row): bool
    {
        if (count($row) !== count($headers)) {
            $this->command->error('Row data does not match header count');

            return false;
        }

        return true;
    }
}
