<?php
// filepath: /mnt/c/Users/miguel.valles/Desktop/string-calculator-kata/src/Rules/EvaluateRules/EvaluateRule.php

namespace MRC\StringCalculator\Rules\EvaluateRules;

interface EvaluateRule
{
    public function supports(string $expression): bool;

    public function apply(string $expression, callable $evaluate): string;
}
