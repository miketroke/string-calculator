<?php

namespace MRC\StringCalculator\Rules\EvaluateRules;

use DivisionByZeroError;

final class DivideRule extends BinaryOperationRule
{
    protected function pattern(): string
    {
        return '/(-?\d+(?:\.\d+)?)\s*\/\s*(-?\d+(?:\.\d+)?)/';
    }

    protected function calculate(float $left, float $right): float
    {
        if ($right == 0.0) {
            throw new DivisionByZeroError('Division by zero');
        }

        return $left / $right;
    }
}
