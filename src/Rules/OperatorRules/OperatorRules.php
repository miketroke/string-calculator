<?php

namespace MRC\StringCalculator\Rules\OperatorRules;

interface OperatorRules
{
    public function supports(string $operation): bool;

    public function apply(array $parts): float;
}
