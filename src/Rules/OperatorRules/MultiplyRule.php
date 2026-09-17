<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

final class MultiplyRule implements OperatorRules
{
    public function supports(string $operation): bool
    {
        return $operation === 'multiply';
    }

    public function apply(array $parts): float
    {
        $result = 1;

        foreach ($parts as $part) {
            $result *= (float) $part;
        }

        return $result;
    }
}
