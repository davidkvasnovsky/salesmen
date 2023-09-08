<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Validation\Rules\InputDataBadFormatRule;
use App\Http\Validation\Rules\InputDataOutOfRangeRule;
use App\Http\Validation\Rules\PersonAlreadyExistsRule;
use Domains\Salesman\Models\Salesman;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Domains\Support\Enums\TitleAfterEnum;
use Domains\Support\Enums\TitleBeforeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

final class CreateSalesmanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => [
                new InputDataBadFormatRule(
                    allowedTypes: ['required', 'string']
                ),
                new InputDataOutOfRangeRule(
                    min: 2,
                    max: 50
                ),
            ],
            'last_name' => [
                new InputDataBadFormatRule(['required', 'string']),
                new InputDataOutOfRangeRule(
                    min: 2,
                    max: 50
                ),
            ],
            'titles_before' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['array', 'enum', 'distinct'],
                    args: ['enum' => TitleBeforeEnum::class],
                ),
                new InputDataOutOfRangeRule(
                    min: 0,
                    max: 10
                ),
            ],
            'titles_after' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['array', 'enum', 'distinct'],
                    args: ['enum' => TitleAfterEnum::class],
                ),
                new InputDataOutOfRangeRule(
                    min: 0,
                    max: 10
                ),
            ],
            'prosight_id' => [
                new InputDataBadFormatRule(
                    allowedTypes: ['required', 'string']
                ),
                new InputDataOutOfRangeRule(
                    min: 5,
                    max: 5
                ),
                new PersonAlreadyExistsRule(
                    table: 'salesmen',
                    object: class_basename(Salesman::class)
                )
            ],
            'email' => [
                new InputDataBadFormatRule(
                    allowedTypes: ['required', 'string', 'email']
                ),
            ],
            'phone' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string', 'phone']
                )
            ],
            'gender' => [
                new InputDataBadFormatRule(
                    allowedTypes: ['string', 'enum'],
                    args: ['enum' => GenderEnum::class],
                )
            ],
            'marital_status' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string', 'enum'],
                    args: ['enum' => MaritalStatusEnum::class],
                )
            ],
        ];
    }
}
