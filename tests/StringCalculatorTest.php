<?php

declare(strict_types=1);

namespace MRC\StringCalculator\Test;

use MRC\StringCalculator\StringCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    private StringCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }

    #[Test]
    public function addReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->add(''));
    }

    #[Test]
    public function addReturnsSameNumberForSingleNumbers(): void
    {
        $this->assertSame("1", $this->calculator->add("1"));
    }

    #[Test]
    public function addReturnsSumForNumbersSeparatedByCommas(): void
    {
        $this->assertSame('3', $this->calculator->add("1,2"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame('3.3', $this->calculator->add("1.1,2.2"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("3.3", $this->calculator->add("1.1\n2.2"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame("6.6", $this->calculator->add("1.1\n2.2,3.3"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame("6.6", $this->calculator->add("1.1\n2.2,3.3,"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersThatUsesCustomSeparatorWhenProvided(): void
    {
        $this->assertSame("6.6", $this->calculator->add("//;\n1.1;2.2;3.3"));
    }

    #[Test]
    public function addReturnsSumForFloatNumbersThatUsesLineBreakOnCustomSeparator(): void
    {
        $this->assertSame("6.6", $this->calculator->add("//\n\n1.1\n2.2\n3.3"));
    }

    #[Test]
    public function addReturnsErrorWhenNegativeNumbersAreProvided(): void
    {
        $this->assertSame("Negative not allowed : -1\nNegative not allowed : -2", $this->calculator->add("-1,-2"));
    }

    #[Test]
    public function addReturnsMultipleErrorsSeparatedByLineBreak(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNumber expected but ',' found at position 3.",
            $this->calculator->add("-1,,2")
        );
    }

    #[Test]
    public function multiplyReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->multiply(''));
    }

    #[Test]
    public function multiplyReturnsSameNumberForSingleNumber(): void
    {
        $this->assertSame("1", $this->calculator->multiply("1"));
    }

    #[Test]
    public function multiplyReturnsProductForNumbersSeparatedByCommas(): void
    {
        $this->assertSame("6", $this->calculator->multiply("2,3"));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame("6.6", $this->calculator->multiply("2.2,3"));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("6.6", $this->calculator->multiply("2.2\n3"));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame("21.78", $this->calculator->multiply("2.2\n3,3.3"));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame("21.78", $this->calculator->multiply("2.2\n3,3.3,"));
    }
}
