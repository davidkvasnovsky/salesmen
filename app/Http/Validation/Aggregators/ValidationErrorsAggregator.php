<?php

declare(strict_types=1);

namespace App\Http\Validation\Aggregators;

use Illuminate\Validation\InvokableValidationRule;
use Illuminate\Validation\Validator;

final class ValidationErrorsAggregator
{
    /**
     * Aggregate validation errors based on their rule classes.
     */
    public static function aggregate(Validator $validator): array
    {
        $aggregatedErrors = [];

        foreach ($validator->getRules() as $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (!$rule instanceof InvokableValidationRule) {
                    continue;
                }

                $ruleInstance = $rule->invokable();
                $ruleClassName = get_class($ruleInstance);

                $aggregatedErrors[$ruleClassName] ??= [];
                $aggregatedErrors[$ruleClassName] = array_merge($aggregatedErrors[$ruleClassName], $rule->message());
            }
        }

        return $aggregatedErrors;
    }
}
