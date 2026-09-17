<?php

namespace MRC\StringCalculator\Rules\ErrorRules;
final class NegativeNumbersRule implements ErrorRules
{
    public function validate(
        string $part,
        int $index,
        array $parts,
        int $position
    ): ?string {
        if ((float) $part < 0) {
            return "Negative not allowed : $part";
        }

        return null;
    }
}
