<?php

namespace MRC\StringCalculator\Rules\ErrorRules;

interface ErrorRules
{
    public function validate(
        string $part,
        int $index,
        array $parts,
        int $position
    ): ?string;

}
