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
        if ($this->isSingleNumber($numbers)) {
            return $numbers;
        }

        return "";
    }

    public function isSingleNumber(string $numbers): bool
    {
        return $numbers === is_numeric($numbers);
    }

}
