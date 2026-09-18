<?php
namespace MRC\StringCalculator\Rules\EvaluateRule;

interface EvaluateRule
{
    public function supports(string $expression): bool;

    public function apply(string $expression, callable $evaluate): string;
}
