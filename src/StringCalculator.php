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
        return "";
    }
}
