<?php

declare(strict_types=1);

namespace App\Http\Controllers\Salesmen;

use App\Http\Exceptions\BadRequestException;
use App\Http\Exceptions\ForbiddenException;
use App\Http\Exceptions\PersonNotFoundException;
use Domains\Salesman\Data\SalesmanResourceData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Throwable;

final readonly class ShowSalesmanController
{
    /**
     * @throws BadRequestException
     * @throws PersonNotFoundException
     */
    #[Get(
        uri: 'salesmen/{salesman_uuid}',
        name: 'salesmen.show',
        middleware: 'api',
    )]
    public function __invoke(Request $request, string $salesman_uuid): SalesmanResourceData
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }

        try {
            return SalesmanResourceData::from(
                Salesman::findOrFail($salesman_uuid)
            );
        } catch (ModelNotFoundException) {
            throw new PersonNotFoundException(
                id: $salesman_uuid,
                object: Salesman::class
            );
        } catch (Throwable) {
            throw new BadRequestException();
        }
    }
}
