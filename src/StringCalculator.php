<?php

declare(strict_types=1);

namespace MRC\StringCalculator;

use InvalidArgumentException;
use Exception;
use Throwable;
use DivisionByZeroError;
final class StringCalculator
{
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

        $operators = [
            '+' => 'add',
            '-' => 'subtract',
            '*' => 'multiply',
            '/' => 'divide',
        ];

        foreach ($operators as $operator => $operation) {
            $position = strrpos($expression, $operator);

            if ($position !== false) {
                $left = substr($expression, 0, $position);
                $right = substr($expression, $position + 1);

                $leftResult = $this->evaluate($left);
                $rightResult = $this->evaluate($right);

                return (string) $this->operate(
                    [$leftResult, $rightResult],
                    $operation
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
        $lastIndex = count($parts) - 1;

        foreach ($parts as $index => $part) {

            if ((float) $part < 0) {
                $errors[] = "Negative not allowed : $part";
            }

            if ($part === '' && $index > 0 && $index < $lastIndex) {
                $errors[] = "Number expected but ',' found at position $position.";
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
        switch ($operation) {
            case 'add':
                return $this->add($parts);

            case 'subtract':
                return $this->subtract($parts);

            case 'multiply':
                return $this->multiply($parts);

            case 'divide':
                return $this->divide($parts);
        }
        throw new InvalidArgumentException("Invalid operation: $operation");
    }

    private function add(array $parts): float
    {
        $result = 0;

        foreach ($parts as $part) {
            $result += (float) $part;
        }

        return $result;
    }

    private function subtract(array $parts): float
    {
        $result = (float) array_shift($parts);

        foreach ($parts as $part) {
            $result -= (float) $part;
        }

        return $result;
    }

    private function multiply(array $parts): float
    {
        $result = 1;

        foreach ($parts as $part) {
            $result *= (float) $part;
        }

        return $result;
    }

    private function divide(array $parts): float
    {
        $result = (float) array_shift($parts);

        foreach ($parts as $part) {
            if ((float) $part === 0.0) {
                throw new DivisionByZeroError('Division by zero not allowed');
            }

            $result /= (float) $part;
        }

        return $result;
    }
}
