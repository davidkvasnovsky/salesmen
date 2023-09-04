<?php

declare(strict_types=1);

namespace App\Http\Controllers\Salesmen;

use App\Http\Exceptions\ForbiddenException;
use App\Http\Requests\CreateSalesmanRequest;
use Domains\Salesman\Data\CreateSalesmanData;
use Domains\Salesman\Data\SalesmanResourceData;
use Domains\Salesman\Models\Salesman;
use Infrastructure\Salesman\Commands\CreateSalesmanContract;
use Spatie\RouteAttributes\Attributes\Post;
use Throwable;

final readonly class CreateSalesmanController
{
    public function __construct(
        private CreateSalesmanContract $command,
    ) {
    }

    #[Post(
        uri: 'salesmen',
        name: 'salesmen.create',
        middleware: 'api'
    )]
    public function __invoke(CreateSalesmanRequest $request): SalesmanResourceData
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }

        try {
            return SalesmanResourceData::from(
                $this->command->handle(CreateSalesmanData::from($request)),
            );
        } catch (Throwable) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }
    }
}
