<?php

namespace MRC\StringCalculator\Rules\EvaluateRule;

use InvalidArgumentException;

class OperatorEvaluateRule implements EvaluateRule
{
    private array $operators = [
        '+' => 'add',
        '-' => 'subtract',
        '*' => 'multiply',
        '/' => 'divide',
    ];

    private array $operatorRules;

    public function __construct(array $operatorRules)
    {
        $this->operatorRules = $operatorRules;
    }

    public function supports(string $expression): bool
    {
        foreach ($this->operators as $operator => $operation) {
            if (str_contains($expression, $operator)) {
                return true;
            }
        }

        return false;
    }

    public function apply(string $expression, callable $evaluate): string
    {
        foreach ($this->operators as $operator => $operation) {

            $position = strrpos($expression, $operator);

            if ($position !== false) {

                $left = substr($expression, 0, $position);
                $right = substr($expression, $position + 1);

                return (string) $this->operate(
                    [
                        $evaluate($left),
                        $evaluate($right)
                    ],
                    $operation
                );
            }
        }

        return $expression;
    }

    private function operate(array $parts, string $operation): float
    {
        foreach ($this->operatorRules as $rule) {
            if ($rule->supports($operation)) {
                return $rule->apply($parts);
            }
        }

        throw new InvalidArgumentException(
            "Invalid operation: $operation"
        );
    }
}
