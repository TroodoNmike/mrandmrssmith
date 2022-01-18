<?php

namespace App\Tests\Service;

use App\Service\Calculate;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider adding
     */
    public function testAdding($start, $numbers, $result)
    {
        $calculator = new Calculate();

        foreach ($numbers as $number) {
            $start = $calculator->add($start, $number);
        }

        $this->assertEquals($result, $start);
    }

    public function adding()
    {
        return [
            [0, [0, 1, 9], 10],
            [0, [4, 5, 0, 0.25], 9.25],
        ];
    }

    /**
     * @dataProvider subtract
     */
    public function testSubtract($start, $numbers, $result)
    {
        $calculator = new Calculate();

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
    public function testMultiply($start, $numbers, $result)
    {
        $calculator = new Calculate();

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
    public function testDivide($start, $numbers, $result)
    {
        $calculator = new Calculate();

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

}
