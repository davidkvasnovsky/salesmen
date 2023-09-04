<?php

declare(strict_types=1);

namespace Infrastructure\Support\Data;

interface CreatableFromCsv
{
    /**
     * @param array $data
     * @return self
     */
    public static function fromCsv(array $data): self;
}
