<?php

namespace MRC\StringCalculator\Rules\EvaluateRules;

abstract class BinaryOperationRule implements EvaluateRule
{
    abstract protected function pattern(): string;

    abstract protected function calculate(float $left, float $right): float;

    public function supports(string $expression): bool
    {
        return preg_match($this->pattern(), $expression) === 1;
    }

    public function apply(string $expression, callable $evaluate): string
    {
        return (string) preg_replace_callback(
            $this->pattern(),
            fn(array $match): string => (string) $this->calculate(
                (float) $match[1],
                (float) $match[2]
            ),
            $expression,
            1
        );
    }
}
