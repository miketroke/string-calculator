<?php

namespace MRC\StringCalculator\Rules\ExpressionRules;


final class AddExpressionRule implements ExpressionRule
{
    public function matches(string $expression): bool
    {
        return (str_contains($expression, "+"));
    }

    public function apply(string $expression): string
    {
        $position = strpos($expression, '+');

        $left = substr($expression, 0, $position);
        $right = substr($expression, $position + 1);

        $rightParts = explode('+', $right, 2);

        if (count($rightParts) === 2) {
            $rightResult = (int) $rightParts[0] + (int) $rightParts[1];

            return $left . '+' . $rightResult;
        }

        return (string) (
            (int) $left + (int) $right
        );
    }
}
