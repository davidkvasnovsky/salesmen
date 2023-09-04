<?php

declare(strict_types=1);

namespace App\Http\Controllers\Salesmen;

use App\Http\Exceptions\ForbiddenException;
use App\Http\Exceptions\PersonNotFoundException;
use App\Http\Requests\UpdateSalesmanRequest;
use Domains\Salesman\Data\SalesmanResourceData;
use Domains\Salesman\Data\UpdateSalesmanData;
use Domains\Salesman\Models\Salesman;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Infrastructure\Salesman\Commands\UpdateSalesmanContract;
use Spatie\RouteAttributes\Attributes\Put;
use Throwable;

final readonly class UpdateSalesmanController
{
    public function __construct(
        private UpdateSalesmanContract $command,
    ) {
    }

    /**
     * @throws PersonNotFoundException
     */
    #[Put(
        uri: 'salesmen/{salesman_uuid}',
        name: 'salesmen.update',
        middleware: 'api',
    )]
    public function __invoke(UpdateSalesmanRequest $request, string $salesman_uuid): SalesmanResourceData
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }

        try {
            return SalesmanResourceData::from(
                payloads: $this->command->handle(
                    payload: UpdateSalesmanData::from($request),
                    id: $salesman_uuid,
                ),
            );
        } catch (ModelNotFoundException) {
            throw new PersonNotFoundException(
                id: $salesman_uuid,
                object: Salesman::class,
            );
        } catch (Throwable) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }
    }
}
