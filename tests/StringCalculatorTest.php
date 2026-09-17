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
    public function itReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->add(''));
    }

    #[Test]
    public function itReturnsSameNumberForSingleNumbers(): void
    {
        $this->assertSame("1", $this->calculator->add("1"));
    }

    #[Test]
    public function itReturnsSumForNumbersSeparatedByCommas(): void
    {
        $this->assertSame('3', $this->calculator->add("1,2"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame('3.3', $this->calculator->add("1.1,2.2"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("3.3", $this->calculator->add("1.1\n2.2"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame("6.6", $this->calculator->add("1.1\n2.2,3.3"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame("6.6", $this->calculator->add("1.1\n2.2,3.3,"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersThatUsesCustomSeparatorWhenProvided(): void
    {
        $this->assertSame("6.6", $this->calculator->add("//;\n1.1;2.2;3.3"));
    }

    #[Test]
    public function itReturnsSumForFloatNumbersThatUsesLineBreakOnCustomSeparator(): void
    {
        $this->assertSame("6.6", $this->calculator->add("//\n\n1.1\n2.2\n3.3"));
    }

    #[Test]
    public function itReturnsErrorWhenNegativeNumbersAreProvided(): void
    {
        $this->assertSame("Negative not allowed : -1\nNegative not allowed : -2", $this->calculator->add("-1,-2"));
    }

    #[Test]
    public function itReturnsMultipleErrorsSeparatedByLineBreak(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNumber expected but ',' found at position 3.",
            $this->calculator->add("-1,,2")
        );
    }
}
