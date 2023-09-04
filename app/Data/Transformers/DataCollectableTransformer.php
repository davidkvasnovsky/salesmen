<?php

declare(strict_types=1);

namespace App\Data\Transformers;

use Illuminate\Support\Str;
use Spatie\LaravelData\Transformers\DataCollectableTransformer as BaseDataCollectableTransformer;

final class DataCollectableTransformer extends BaseDataCollectableTransformer
{
    /**
     * @param array<string> $paginated
     * @return array<string, array<string, string>|string>
     */
    protected function wrapPaginatedArray(array $paginated): array
    {
        $wrapKey = $this->wrap->getKey() ?? 'data';

        return [
            $wrapKey => $paginated['data'],


            'links' => [
                'first' => Str::remove(url('/'), $paginated['first_page_url']),
                'last' => Str::remove(url('/'), $paginated['last_page_url']),
                'prev' => Str::remove(url('/'), $paginated['prev_page_url']),
                'next' => Str::remove(url('/'), $paginated['next_page_url']),
            ],
        ];
    }
}
