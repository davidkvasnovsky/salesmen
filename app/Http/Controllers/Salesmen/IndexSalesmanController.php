<?php

declare(strict_types=1);

namespace App\Http\Controllers\Salesmen;

use App\Http\Exceptions\BadRequestException;
use App\Http\Exceptions\ForbiddenException;
use Domains\Salesman\Data\SalesmanResourceData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Schema;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\RouteAttributes\Attributes\Get;
use Throwable;

final class IndexSalesmanController
{
    /**
     * @throws BadRequestException
     */
    #[Get(
        uri: 'salesmen',
        name: 'salesmen.index',
        middleware: 'api'
    )]
    public function __invoke(Request $request): PaginatedDataCollection
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }

        try {
            $columns = Cache::remember(
                key: 'salesman_columns',
                ttl: 60,
                callback: fn () => Schema::getColumnListing(
                    table: (new Salesman())->getTable()
                )
            );

            return SalesmanResourceData::collection(
                QueryBuilder::for(subject: Salesman::class)
                    ->allowedSorts($columns)
                    ->paginate(
                        perPage: $request->get(
                            key: 'per_page',
                            default: 15
                        ),
                    )
            );
        } catch (Throwable) {
            throw new BadRequestException();
        }
    }
}
