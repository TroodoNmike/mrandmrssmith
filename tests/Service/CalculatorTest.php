<?php

namespace App\Tests\Service;

use App\Exception\DivideByZeroException;
use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @param array<int> $numbers
     * @dataProvider adding
     */
    public function testAdding(int $start, array $numbers, float $result): void
    {
        $calculator = new Calculator();

        foreach ($numbers as $number) {
            $start = $calculator->add($start, $number);
        }

        $this->assertEquals($result, $start);
    }

    public function adding(): array
    {
        return [
            [0, [0, 1, 9], 10],
            [0, [4, 5, 0, 0.25], 9.25],
        ];
    }

    /**
     * @dataProvider subtract
     */
    public function testSubtract(int $start, array $numbers, float $result): void
    {
        $calculator = new Calculator();

        foreach ($numbers as $number) {
            $start = $calculator->subtract($start, $number);
        }

        $this->assertEquals($result, $start);
    }

    public function subtract()
    {
        return [
            [0, [10, 5], -15],
            [20, [10, 5], 5],
            [20, [10, 5, 2.25], 2.75],
        ];
    }


    /**
     * @dataProvider multiply
     */
    public function testMultiply(int $start, array $numbers, float $result): void
    {
        $calculator = new Calculator();

        foreach ($numbers as $number) {
            $start = $calculator->multiply($start, $number);
        }

        $this->assertEquals($result, $start);
    }

    public function multiply()
    {
        return [
            [0, [3, 3], 0],
            [1, [3, 3], 9],
        ];
    }

    /**
     * @dataProvider divide
     */
    public function testDivide(int $start, array $numbers, float $result): void
    {
        $calculator = new Calculator();

        foreach ($numbers as $number) {
            $start = $calculator->divide($start, $number);
        }

        $this->assertEquals($result, $start);
    }

    public function divide()
    {
        return [
            [12, [3], 4],
            [12, [3, 2], 2],
            [81, [9, 3, 3], 1],
        ];
    }

    public function testDivideByZero(): void
    {
        $this->expectException(DivideByZeroException::class);
        $this->expectExceptionMessage('Cannot divide by 0');

        $calculator = new Calculator();
        $calculator->divide(1, 0);
    }
}
