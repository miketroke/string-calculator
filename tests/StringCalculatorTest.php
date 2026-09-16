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
        $this->assertSame("3.3", $this->calculator->add('1.1\n2.2'));
    }
}
