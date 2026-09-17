<?php

declare(strict_types=1);

namespace MRC\StringCalculator\Test;

use MRC\StringCalculator\StringCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MultiplyCalculatorTest extends TestCase
{
    private StringCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }


    #[Test]
    public function multiplyReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->calculate('', 'multiply'));
    }

    #[Test]
    public function multiplyReturnsSameNumberForSingleNumber(): void
    {
        $this->assertSame("1", $this->calculator->calculate("1", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForNumbersSeparatedByCommas(): void
    {
        $this->assertSame("6", $this->calculator->calculate("2,3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByCommas(): void
    {
        $this->assertSame("6.6", $this->calculator->calculate("2.2,3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreak(): void
    {
        $this->assertSame("6.6", $this->calculator->calculate("2.2\n3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreakAndCommas(): void
    {
        $this->assertSame("21.78", $this->calculator->calculate("2.2\n3,3.3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersSeparatedByLineBreakAndCommasWithTrailingComma(): void
    {
        $this->assertSame("21.78", $this->calculator->calculate("2.2\n3,3.3,", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersThatUsesCustomSeparatorWhenProvided(): void
    {
        $this->assertSame("21.78", $this->calculator->calculate("//;\n2.2;3;3.3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsProductForFloatNumbersThatUsesLineBreakOnCustomSeparator(): void
    {
        $this->assertSame("21.78", $this->calculator->calculate("//\n\n2.2\n3\n3.3", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsErrorWhenNegativeNumbersAreProvided(): void
    {
        $this->assertSame("Negative not allowed : -1\nNegative not allowed : -2", $this->calculator->calculate("-1,-2", 'multiply'));
    }

    #[Test]
    public function multiplyReturnsMultipleErrorsSeparatedByLineBreak(): void
    {
        $this->assertSame(
            "Negative not allowed : -1\nNumber expected but ',' found at position 3.",
            $this->calculator->calculate("-1,,2", 'multiply')
        );
    }
}
