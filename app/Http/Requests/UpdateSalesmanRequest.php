<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Validation\Rules\InputDataBadFormatRule;
use App\Http\Validation\Rules\InputDataOutOfRangeRule;
use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Domains\Support\Enums\TitleAfterEnum;
use Domains\Support\Enums\TitleBeforeEnum;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateSalesmanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string']
                ),
                new InputDataOutOfRangeRule(
                    min: 2,
                    max: 50
                ),
            ],
            'last_name' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string']
                ),
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
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string']
                ),
                new InputDataOutOfRangeRule(
                    min: 5,
                    max: 5
                ),
            ],
            'email' => [
                'sometimes',
                'nullable',
                new InputDataBadFormatRule(
                    allowedTypes: ['string', 'email']
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
                'sometimes',
                'nullable',
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
