<?php

declare(strict_types=1);

namespace App\Http\Exceptions;

use App\Http\Enums\ResponseCodeEnum;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class BadRequestException extends HttpException implements Renderable
{
    public function __construct()
    {
        $this->message = 'Query execution failed.';

        parent::__construct(
            statusCode: Response::HTTP_BAD_REQUEST,
            message: $this->message
        );
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'code' => ResponseCodeEnum::BAD_REQUEST->name,
                'message' => $this->message,
            ]
        ], status: Response::HTTP_BAD_REQUEST);
    }
}
