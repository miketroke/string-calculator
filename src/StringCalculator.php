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

        $parts = $this->parseNumbers($numbers);

        if (count($parts) > 1) {
            return $this->sum($parts);
        }

        return $numbers;
    }

    public function isEmpty(string $numbers): bool
    {
        return $numbers === "";
    }

    public function parseNumbers(string $numbers): array
    {
        $numbers = str_replace('\n', ',', $numbers);
        return explode(',', $numbers);
    }

    public function sum(array $parts): string
    {
        $sum = 0;

        foreach ($parts as $part) {
            $sum += (float) $part;
        }
        return (string) $sum;
    }
}
