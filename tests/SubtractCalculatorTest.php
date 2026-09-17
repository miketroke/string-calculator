<?php

declare(strict_types=1);

namespace MRC\StringCalculator\Test;

use MRC\StringCalculator\StringCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SubtractCalculatorTest extends TestCase
{
    private StringCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }

    #[Test]
    public function subtractReturnsZeroForEmptyString(): void
    {
        $this->assertSame(
            '0',
            $this->calculator->calculate('', 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsSameNumberForSingleNumber(): void
    {
        $this->assertSame(
            '5',
            $this->calculator->calculate('5', 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForNumbersSeparatedByCommas(): void
    {
        $this->assertSame(
            '3',
            $this->calculator->calculate('6,3', 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame(
            '3.3',
            $this->calculator->calculate('6.6,3.3', 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame(
            '3.3',
            $this->calculator->calculate("6.6\n3.3", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame(
            '2.2',
            $this->calculator->calculate("8.8\n3.3,3.3", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame(
            '2.2',
            $this->calculator->calculate("8.8\n3.3,3.3,", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersThatUsesCustomSeparatorWhenProvided(): void
    {
        $this->assertSame(
            '2.2',
            $this->calculator->calculate("//;\n8.8;3.3;3.3", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsDifferenceForFloatNumbersThatUsesLineBreakOnCustomSeparator(): void
    {
        $this->assertSame(
            '2.2',
            $this->calculator->calculate("//\n\n8.8\n3.3\n3.3", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsErrorWhenNegativeNumbersAreProvided(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNegative not allowed : -2",
            $this->calculator->calculate("-1,-2", 'subtract')
        );
    }

    #[Test]
    public function subtractReturnsMultipleErrorsSeparatedByLineBreak(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNumber expected but ',' found at position 3.",
            $this->calculator->calculate("-1,,2", 'subtract')
        );
    }
}
