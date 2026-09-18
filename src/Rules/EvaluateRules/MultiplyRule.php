<?php
// filepath: /mnt/c/Users/miguel.valles/Desktop/string-calculator-kata/src/Rules/EvaluateRules/MultiplyRule.php

namespace MRC\StringCalculator\Rules\EvaluateRules;

final class MultiplyRule extends BinaryOperationRule
{
    protected function pattern(): string
    {
        return '/(-?\d+(?:\.\d+)?)\s*\*\s*(-?\d+(?:\.\d+)?)/';
    }

    protected function calculate(float $left, float $right): float
    {
        return $left * $right;
    }
}
