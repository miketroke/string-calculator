<?php

declare(strict_types=1);

namespace MRC\StringCalculator;

use InvalidArgumentException;
use Exception;
use Throwable;

use MRC\StringCalculator\Rules\ErrorRules\MissingNumberRule;
use MRC\StringCalculator\Rules\ErrorRules\NegativeNumbersRule;

use MRC\StringCalculator\Rules\OperatorRules\AddRule;
use MRC\StringCalculator\Rules\OperatorRules\DivideRule;
use MRC\StringCalculator\Rules\OperatorRules\MultiplyRule;
use MRC\StringCalculator\Rules\OperatorRules\SubtractRule;

use MRC\StringCalculator\Rules\EvaluateRule\OperatorEvaluateRule;
use MRC\StringCalculator\Rules\EvaluateRule\ParenthesesRule;

final class StringCalculator
{
    private array $errorRules;
    private array $operatorRules;

    private array $evaluateRule;

    public function __construct()
    {
        $this->errorRules = [
            new NegativeNumbersRule(),
            new MissingNumberRule(),
        ];

        $this->operatorRules = [
            new AddRule(),
            new SubtractRule(),
            new MultiplyRule(),
            new DivideRule(),
        ];

        $this->evaluateRule = [
            new ParenthesesRule(),
            new OperatorEvaluateRule($this->operatorRules),
        ];
    }

    public function calculate(string $numbers, string $operation): string
    {
        try {
            return (string) $this->operationInternal($numbers, $operation);
        } catch (Throwable $e) {
            return $e->getMessage();
        }
    }

    public function evaluate(string $expression): string
    {
        if ($this->isEmpty($expression)) {
            return '0';
        }

        foreach ($this->evaluateRule as $rule) {

            if ($rule->supports($expression)) {
                return $rule->apply(
                    $expression,
                    fn(string $value) => $this->evaluate($value)
                );
            }

        }

        return $expression;
    }

    private function operationInternal(string $numbers, string $operation): float
    {
        if ($this->isEmpty($numbers)) {
            return 0;
        }

        $separator = "\n";

        if ($this->startsWithDoubleSlash($numbers)) {
            [$separator, $numbers] = $this->parseCustomSeparator($numbers);
        }

        $parts = $this->parseNumbers($numbers, $separator);

        $errors = $this->getErrors($parts);

        if ($errors) {
            throw new Exception(implode("\n", $errors));
        }

        if ($this->hasNumbers($parts)) {
            return (float) $this->operate($parts, $operation);
        }

        return (float) $numbers;
    }

    private function isEmpty(string $numbers): bool
    {
        return $numbers === "";
    }

    private function startsWithDoubleSlash(string $numbers): bool
    {
        return str_starts_with($numbers, "//");
    }

    private function parseCustomSeparator(string $numbers): array
    {
        $numbers = substr($numbers, 2);

        if ($this->startsWithDoubleLineBreak($numbers)) {
            $numbers = substr($numbers, 2);
            return ["\n", $numbers];
        }

        $lineBreakPosition = strpos($numbers, "\n");
        $separator = substr($numbers, 0, $lineBreakPosition);
        $numbers = substr($numbers, $lineBreakPosition + 1);

        return [$separator, $numbers];
    }

    private function startsWithDoubleLineBreak(string $numbers): bool
    {
        return str_starts_with($numbers, "\n\n");
    }

    private function parseNumbers(string $numbers, string $separator): array
    {
        $numbers = str_replace($separator, ',', $numbers);
        $parts = explode(',', $numbers);

        if (end($parts) === '') {
            array_pop($parts);
        }
        return $parts;
    }

    private function getErrors(array $parts): array
    {
        $errors = [];
        $position = 0;

        foreach ($parts as $index => $part) {
            foreach ($this->errorRules as $rule) {
                $error = $rule->validate($part, $index, $parts, $position);

                if ($error !== null) {
                    $errors[] = $error;
                }
            }

            $position += strlen($part) + 1;
        }

        return $errors;
    }

    private function hasNumbers(array $parts): bool
    {
        return count($parts) > 1;
    }

    private function operate(array $parts, string $operation): float
    {
        foreach ($this->operatorRules as $rule) {
            if ($rule->supports($operation)) {
                return $rule->apply($parts);
            }
        }
        throw new InvalidArgumentException("Invalid operation: $operation");
    }
}
