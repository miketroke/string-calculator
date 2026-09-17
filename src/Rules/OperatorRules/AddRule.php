<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

final class AddRule implements OperatorRules
{
    public function supports(string $operation): bool
    {
        return $operation === 'add';
    }

    public function apply(array $parts): float
    {
        $result = 0;

        foreach ($parts as $part) {
            $result += (float) $part;
        }

        return $result;
    }
}
