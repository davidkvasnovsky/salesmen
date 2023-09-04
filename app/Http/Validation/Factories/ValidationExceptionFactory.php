<?php

declare(strict_types=1);

namespace App\Http\Validation\Factories;

use App\Http\Validation\Aggregators\ValidationErrorsAggregator;
use App\Http\Validation\Enums\ValidationErrorTypeEnum;
use App\Http\Validation\Exceptions\BaseValidationException;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Validator;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ValidationExceptionFactory
{
    public static function make(Validator $validator): HttpException
    {
        $aggregatedErrors = ValidationErrorsAggregator::aggregate($validator);

        if (empty($aggregatedErrors)) {
            throw new RuntimeException('No validation errors to aggregate.');
        }

        $exceptionConfig = Config::get(
            key: 'validation.exceptions',
            default: [],
        );

        if (empty($exceptionConfig) || !is_array($exceptionConfig)) {
            throw new RuntimeException('Invalid or empty validation exception configuration.');
        }

        return self::createExceptionFromConfig($aggregatedErrors, $exceptionConfig);
    }

    private static function createExceptionFromConfig(array $aggregatedErrors, array $config): BaseValidationException
    {
        foreach ($aggregatedErrors as $ruleClass => $messages) {
            if (empty($messages)) {
                continue;
            }

            $ruleConfig = $config[$ruleClass] ?? null;

            if (!is_array($ruleConfig)) {
                continue;
            }

            $exceptionClass = $ruleConfig['exception'] ?? null;
            $errorType = $ruleConfig['type'] ?? null;

            if (!$errorType instanceof ValidationErrorTypeEnum) {
                throw new RuntimeException(message: "Invalid exception type for rule {$ruleClass}: {$errorType}.");
            }

            if (!class_exists($exceptionClass) || !is_subclass_of(
                $exceptionClass,
                class: BaseValidationException::class
            )) {
                throw new RuntimeException(
                    message: "Invalid exception class for rule {$ruleClass}: {$exceptionClass}."
                );
            }

            return new $exceptionClass(
                statusCode: $errorType->statusCode(),
                errorCode: $errorType->value,
                messages: $messages
            );
        }

        throw new RuntimeException('Failed to create a validation exception from the aggregated errors.');
    }
}
