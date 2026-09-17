<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

use DivisionByZeroError;

final class DivideRule implements OperatorRules
{
    public function supports(string $operation): bool
    {
        return $operation === 'divide';
    }

    public function apply(array $parts): float
    {
        $result = (float) array_shift($parts);

        foreach ($parts as $part) {
            if ((float) $part === 0.0) {
                throw new DivisionByZeroError('Division by zero not allowed');
            }

            $result /= (float) $part;
        }

        return $result;
    }
}
