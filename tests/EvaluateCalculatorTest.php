<?php

declare(strict_types=1);

namespace MRC\StringCalculator\Test;

use MRC\StringCalculator\StringCalculator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EvaluateCalculatorTest extends TestCase
{
    private StringCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }

    #[Test]
    public function evaluateReturnsZeroForEmptyString(): void
    {
        $this->assertSame('0', $this->calculator->evaluate(""));
    }

    #[Test]
    public function evaluateReturnsSameNumberForSingleNumber(): void
    {
        $this->assertSame("1", $this->calculator->evaluate("1"));
    }

    #[Test]
    public function evaluateReturnsResultOnAddition(): void
    {
        $this->assertSame("3", $this->calculator->evaluate("1+2"));
    }

    #[Test]
    public function evaluateReturnsResultOnAdditionWithMultipleNumbers(): void
    {
        $this->assertSame("6", $this->calculator->evaluate("1+2+3"));
    }

    #[Test]
    public function evaluateReturnsResultOnSubtraction(): void
    {
        $this->assertSame("1", $this->calculator->evaluate("3-2"));
    }

    #[Test]
    public function evaluateReturnsResultOnSubtractionWithMultipleNumbers(): void
    {
        $this->assertSame("0", $this->calculator->evaluate("3-2-1"));
    }

    // #[Test]
    // public function evaluateReturnsResultOnMultiplication(): void
    // {
    //     $this->assertSame("6", $this->calculator->evaluate("2*3"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnMultiplicationWithMultipleNumbers(): void
    // {
    //     $this->assertSame("24", $this->calculator->evaluate("2*3*4"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnDivision(): void
    // {
    //     $this->assertSame("2", $this->calculator->evaluate("6/3"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnDivisionWithMultipleNumbers(): void
    // {
    //     $this->assertSame("1", $this->calculator->evaluate("6/3/2"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnMixedOperationsWithAdditionAndSubtraction(): void
    // {
    //     $this->assertSame("2", $this->calculator->evaluate("1+2-1"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnMixedOperationsWithMultiplicationAndDivision(): void
    // {
    //     $this->assertSame("2", $this->calculator->evaluate("2*3/3"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnMixedOperationsWithAllOperators(): void
    // {
    //     $this->assertSame("3", $this->calculator->evaluate("1+2*3/3"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnMixedOperationsWithAllOperatorsAndMultipleNumbers(): void
    // {
    //     $this->assertSame("4", $this->calculator->evaluate("1+2*3/3-1+2"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnComplexMixedOperationsWithParentheses(): void
    // {
    //     $this->assertSame("7", $this->calculator->evaluate("1+(2*3)"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnComplexMixedOperationsWithMultipleParentheses(): void
    // {
    //     $this->assertSame("9", $this->calculator->evaluate("1+(2*3)+(4-2)"));
    // }

    // #[Test]
    // public function evaluateReturnsResultOnComplexMixedOperationsWithMultipleParenthesesAndAllOperators(): void
    // {
    //     $this->assertSame("8", $this->calculator->evaluate("1+(2*3)+(4-2)/2"));
    // }

}

