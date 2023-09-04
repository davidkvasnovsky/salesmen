<?php

declare(strict_types=1);

namespace App\Data\Collections;

use App\Data\Transformers\DataCollectableTransformer;
use Spatie\LaravelData\PaginatedDataCollection as BasePaginatedDataCollection;
use Spatie\LaravelData\Support\Wrapping\WrapExecutionType;

final class PaginatedDataCollection extends BasePaginatedDataCollection
{
    public function transform(
        bool $transformValues = true,
        WrapExecutionType $wrapExecutionType = WrapExecutionType::Disabled,
        bool $mapPropertyNames = true,
    ): array {
        $transformer = new DataCollectableTransformer(
            $this->dataClass,
            $transformValues,
            $wrapExecutionType,
            $mapPropertyNames,
            $this->getPartialTrees(),
            $this->items,
            $this->getWrap(),
        );

        return $transformer->transform();
    }
}
