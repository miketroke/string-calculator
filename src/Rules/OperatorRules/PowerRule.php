<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

final class PowerRule implements OperatorRules
{
    public function supports(string $operation): bool
    {
        return $operation === 'power';
    }

    public function apply(array $parts): float
    {
        return pow(
            (float) $parts[0],
            (float) $parts[1]
        );
    }
}
