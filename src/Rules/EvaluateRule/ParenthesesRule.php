<?php
namespace MRC\StringCalculator\Rules\EvaluateRule;

class ParenthesesRule implements EvaluateRule
{
    public function supports(string $expression): bool
    {
        return str_contains($expression, '(');
    }

    public function apply(string $expression, callable $evaluate): string
    {
        $close = strpos($expression, ')');

        $beforeClose = substr($expression, 0, $close);
        $open = strrpos($beforeClose, '(');

        $inside = substr(
            $expression,
            $open + 1,
            $close - $open - 1
        );

        $result = $evaluate($inside);

        $expression =
            substr($expression, 0, $open)
            . $result
            . substr($expression, $close + 1);

        return $evaluate($expression);
    }
}
