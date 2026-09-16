<?php

declare(strict_types=1);

namespace MRC\StringCalculator;


final class StringCalculator
{
    public function add(string $numbers): string
    {
        if ($this->isEmpty($numbers)) {
            return '0';
        }

        $separator = "\n";

        if ($this->startsWithDoubleSlash($numbers)) {
            [$separator, $numbers] = $this->parseNumbersWithSeparator($numbers);
        }

        $parts = $this->parseNumbers($numbers, $separator);

        if ($this->hasNumbers($parts)) {
            return $this->sum($parts);
        }

        return $numbers;
    }

    private function isEmpty(string $numbers): bool
    {
        return $numbers === "";
    }

    private function startsWithDoubleSlash(string $numbers): bool
    {
        return str_starts_with($numbers, "//");
    }

    private function parseNumbersWithSeparator(string $numbers): array
    {
        $numbers = substr($numbers, 2);
        $lineBreakPosition = strpos($numbers, "\n");
        $separator = substr($numbers, 0, $lineBreakPosition);
        $numbers = substr($numbers, $lineBreakPosition + 1);

        return [$separator, $numbers];
    }

    private function parseNumbers(string $numbers, string $separator): array
    {
        $numbers = str_replace($separator, ',', $numbers);
        return explode(',', $numbers);
    }

    private function hasNumbers(array $parts): bool
    {
        return count($parts) > 1;
    }
    private function sum(array $parts): string
    {
        $sum = 0;

        foreach ($parts as $part) {
            $sum += (float) $part;
        }
        return (string) $sum;
    }
}
