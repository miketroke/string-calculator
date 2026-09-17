<?php

declare(strict_types=1);

namespace MRC\StringCalculator\Test;

use MRC\StringCalculator\StringCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DivideCalculatorTest extends TestCase
{
    private StringCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }

    #[Test]
    public function divideReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->calculate('', 'divide'));
    }

    #[Test]
    public function divideReturnsSameNumberForSingleNumber(): void
    {
        $this->assertSame("1", $this->calculator->calculate("1", 'divide'));
    }

    #[Test]
    public function divideReturnsQuotientForNumbersSeparatedByCommas(): void
    {
        $this->assertSame("2", $this->calculator->calculate("6,3", 'divide'));
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame("2.2", $this->calculator->calculate("6.6,3", 'divide'));
    }

    #[Test]
    public function divideReturnsZeroForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame("0", $this->calculator->calculate("0,3", 'divide'));
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("2.2", $this->calculator->calculate("6.6\n3", 'divide'));
    }

    #[Test]
    public function divideReturnsZeroForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("0", $this->calculator->calculate("0\n3", 'divide'));
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame(
            "2.2",
            $this->calculator->calculate("13.2\n3,2", 'divide')
        );
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame(
            "2.2",
            $this->calculator->calculate("13.2\n3,2,", 'divide')
        );
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersThatUsesCustomSeparatorWhenProvided(): void
    {
        $this->assertSame(
            "2.2",
            $this->calculator->calculate("//;\n13.2;3;2", 'divide')
        );
    }

    #[Test]
    public function divideReturnsQuotientForFloatNumbersThatUsesLineBreakOnCustomSeparator(): void
    {
        $this->assertSame(
            "2.2",
            $this->calculator->calculate("//\n\n13.2\n3\n2", 'divide')
        );
    }

    #[Test]
    public function divideReturnsErrorWhenNegativeNumbersAreProvided(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNegative not allowed : -2",
            $this->calculator->calculate("-1,-2", 'divide')
        );
    }

    #[Test]
    public function divideReturnsMultipleErrorsSeparatedByLineBreak(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNumber expected but ',' found at position 3.",
            $this->calculator->calculate("-1,,2", 'divide')
        );
    }
}
