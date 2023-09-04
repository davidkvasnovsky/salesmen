<?php

declare(strict_types=1);

namespace App\Http\Controllers\Salesmen;

use App\Http\Exceptions\ForbiddenException;
use Domains\Salesman\Models\Salesman;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Salesman\Commands\DestroySalesmanContract;
use Spatie\RouteAttributes\Attributes\Delete;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final readonly class DestroySalesmanController
{
    public function __construct(
        private DestroySalesmanContract $command,
    ) {
    }

    #[Delete(
        uri: 'salesmen/{salesman_uuid}',
        name: 'salesmen.destroy',
        middleware: 'api'
    )]
    public function __invoke(Request $request, string $salesman_uuid): JsonResponse
    {
        if (!$request->user()) {
            throw new ForbiddenException(
                object: Salesman::class
            );
        }

        try {
            if ($this->command->handle($salesman_uuid)) {
                return response()->json(status: Response::HTTP_NO_CONTENT);
            }
        } catch (Throwable) {
            // Catching all exceptions to ensure the controller only returns 403 or 204.
        }

        throw new ForbiddenException(
            object: Salesman::class
        );
    }
}
