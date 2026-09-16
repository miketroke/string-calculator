<?php

declare(strict_types=1);

namespace MRC\StringCalculator;

final class StringCalculator
{
    public function add(string $numbers): string
    {
        if ($numbers === "") {
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

        return $numbers;
    }

}
