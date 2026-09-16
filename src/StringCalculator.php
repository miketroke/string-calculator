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

        $parts = explode(',', $numbers);

        if (count($parts) > 1) {
            $sum = 0;

            foreach ($parts as $part) {
                $sum += (float) $part;
            }
            return (string) $sum;
        }

        $parts2 = explode('\n', $numbers);
        if (count($parts2) > 1) {
            $sum = 0;

            foreach ($parts2 as $part) {
                $sum += (float) $part;
            }
            return (string) $sum;
        }

        return $numbers;
    }

    public function isEmpty(string $numbers): bool
    {
        return $numbers === "";
    }
}
