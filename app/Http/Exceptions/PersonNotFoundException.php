<?php

declare(strict_types=1);

namespace App\Http\Exceptions;

use App\Http\Enums\ResponseCodeEnum;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PersonNotFoundException extends HttpException implements Renderable
{
    public function __construct(
        public string $id,
        public string $object,
    ) {
        $this->object = class_basename($object);
        $this->message = "{$this->object} with such uuid not found. [{$this->object} \"{$this->id}\" not found.]";

        parent::__construct(
            statusCode: Response::HTTP_NOT_FOUND,
            message: $this->message
        );
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'errors' => [
                'code' => ResponseCodeEnum::PERSON_NOT_FOUND->name,
                'message' => $this->message,
            ]
        ], status: Response::HTTP_NOT_FOUND);
    }
}
