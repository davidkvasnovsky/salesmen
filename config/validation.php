<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Handlers
    |--------------------------------------------------------------------------
    |
    | This section allows you to define custom validation handlers for each
    | ValidationRule class that implements the HandlerAwareRule interface.
    | These handlers are responsible for executing the actual validation
    | logic for their corresponding rules.
    |
    | You can list multiple handlers for each ValidationRule class. Handlers
    | will be invoked in the order they are listed, providing you with the
    | flexibility to compose complex validation logic by chaining
    | together simpler, reusable handlers.
    |
    */

    'handlers' => [
        App\Http\Validation\Rules\InputDataBadFormatRule::class => [
            App\Http\Validation\Handlers\RequiredValidationHandler::class,
            App\Http\Validation\Handlers\TypeValidationHandler::class,
            App\Http\Validation\Handlers\EmailValidationHandler::class,
            App\Http\Validation\Handlers\AlphaValidationHandler::class,
            App\Http\Validation\Handlers\PhoneValidationHandler::class,
            App\Http\Validation\Handlers\EnumValidationHandler::class,
            App\Http\Validation\Handlers\DistinctValidationHandler::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Validation Exceptions and Error Types
    |--------------------------------------------------------------------------
    |
    | This section allows you to map custom exception classes and error types
    | to each ValidationRule class. The 'exception' key specifies the
    | exception class to be thrown, and the 'type' key specifies the
    | error type enum that will be used to determine the status
    | code and error code in the exception's response.
    |
    */

    'exceptions' => [
        App\Http\Validation\Rules\InputDataBadFormatRule::class => [
            'exception' => App\Http\Validation\Exceptions\InputDataBadFormatException::class,
            'type' => \App\Http\Validation\Enums\ValidationErrorTypeEnum::InputDataBadFormat,
        ],
        App\Http\Validation\Rules\InputDataOutOfRangeRule::class => [
            'exception' => App\Http\Validation\Exceptions\InputDataOutOfRangeException::class,
            'type' => \App\Http\Validation\Enums\ValidationErrorTypeEnum::InputDataOutOfRange,
        ],
        App\Http\Validation\Rules\PersonAlreadyExistsRule::class => [
            'exception' => App\Http\Validation\Exceptions\PersonAlreadyExistsException::class,
            'type' => \App\Http\Validation\Enums\ValidationErrorTypeEnum::PersonAlreadyExists,
        ],
    ],

];
