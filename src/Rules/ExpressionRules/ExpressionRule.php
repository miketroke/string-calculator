<?php

namespace MRC\StringCalculator\Rules\ExpressionRules;

interface ExpressionRule
{
    public function matches(string $expression): bool;

    public function apply(string $expression): string;
}
