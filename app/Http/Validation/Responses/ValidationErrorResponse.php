<?php

declare(strict_types=1);

namespace App\Http\Validation\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final class ValidationErrorResponse implements Responsable
{
    public function __construct(
        protected int $statusCode,
        protected string $errorCode,
        protected array $messages
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        $transformed = [];

        foreach ($this->messages as $message) {
            $transformed[] = [
                'code' => $this->errorCode,
                'message' => $message,
            ];
        }

        return response()->json(['errors' => $transformed], $this->statusCode);
    }
}
