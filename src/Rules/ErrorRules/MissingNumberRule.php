<?php

namespace MRC\StringCalculator\Rules\ErrorRules;

final class MissingNumberRule implements ErrorRules
{
    public function validate(
        string $part,
        int $index,
        array $parts,
        int $position
    ): ?string {
        $lastIndex = count($parts) - 1;

        if ($part === '' && $index > 0 && $index < $lastIndex) {
            return "Number expected but ',' found at position $position.";
        }

        return null;
    }
}
