<?php

declare(strict_types=1);

namespace App\Http\Exceptions;

use App\Http\Enums\ResponseCodeEnum;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ForbiddenException extends HttpException implements Renderable
{
    public function __construct(
        private readonly string $object,
    ) {
        $this->$object = class_basename($object);
        $this->message = "You are not allowed to perform this action on {$this->$object} object.";

        parent::__construct(
            statusCode: Response::HTTP_FORBIDDEN,
            message: $this->message,
        );
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'code' => ResponseCodeEnum::FORBIDDEN->name,
                'message' => $this->message,
            ]
        ], status: Response::HTTP_FORBIDDEN);
    }
}
