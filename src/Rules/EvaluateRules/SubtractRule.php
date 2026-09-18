<?php

namespace MRC\StringCalculator\Rules\EvaluateRules;

final class SubtractRule extends BinaryOperationRule
{
    protected function pattern(): string
    {
        return '/(-?\d+(?:\.\d+)?)\s*-\s*(-?\d+(?:\.\d+)?)/';
    }

    protected function calculate(float $left, float $right): float
    {
        return $left - $right;
    }
}
