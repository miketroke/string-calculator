<?php

namespace MRC\StringCalculator\Rules\ExpressionRules;

final class SubtractExpressionRule implements ExpressionRule
{
    public function matches(string $expression): bool
    {
        return (str_contains($expression, "-"));
    }

    public function apply(string $expression): string
    {
        $position = strpos($expression, '-');

        if ($position !== false) {
            [$left, $right] = explode('-', $expression);

            return (string) (
                (int) $left - (int) $right
            );
        }
        return $expression;
    }
}
