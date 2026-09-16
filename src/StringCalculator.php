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
        if ($numbers === is_numeric($numbers)) {
            return $numbers;
        }
        return "";
    }
}
