<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

interface OperatorRules
{
    public function matches(string $operation): bool;

    public function apply(array $parts): float;
}
