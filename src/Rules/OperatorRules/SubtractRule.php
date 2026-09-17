<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

final class SubtractRule implements OperatorRules
{
    public function supports(string $operation): bool
    {
        return $operation === 'subtract';
    }

    public function apply(array $parts): float
    {
        $result = (float) array_shift($parts);

        foreach ($parts as $part) {
            $result -= (float) $part;
        }

        return $result;
    }
}
