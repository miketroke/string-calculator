<?php

namespace MRC\StringCalculator\Rules\EvaluateRules;

use InvalidArgumentException;

final class ParenthesesRule implements EvaluateRule
{
    public function supports(string $expression): bool
    {
        return str_contains($expression, '(')
            || str_contains($expression, ')');
    }

    public function apply(string $expression, callable $evaluate): string
    {
        while (str_contains($expression, '(')) {
            $result = preg_replace_callback(
                '/\(([^()]*)\)/',
                static fn(array $match): string => $evaluate($match[1]),
                $expression
            );

            if ($result === null || $result === $expression) {
                throw new InvalidArgumentException('Unbalanced parentheses.');
            }

            $expression = $result;
        }

        if (str_contains($expression, ')')) {
            throw new InvalidArgumentException('Unbalanced parentheses.');
        }

        return $evaluate($expression);
    }
}
