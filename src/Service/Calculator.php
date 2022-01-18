<?php

namespace App\Service;

use App\Exception\DivideByZeroException;

class Calculator
{
    public const CALCULATIONS_TYPES = ['+', '-', '*', '/'];

    public function add(float $digit1, float $digit2): float
    {
        return $digit1 + $digit2;
    }

    public function subtract(float $arg1, float $arg2): float
    {
        return $arg1 - $arg2;
    }

    public function multiply(float $arg1, float $arg2): float
    {
        return $arg1 * $arg2;
    }

    public function divide(float $arg1, float $arg2): float
    {
        try {
            return $arg1 / $arg2;
        } catch (\DivisionByZeroError $e){
            throw new DivideByZeroException('Cannot divide by 0');
        }
    }

    public function calculate(float $arg1, float $arg2, string $type): float
    {
        switch ($type) {
            case '+':
                return $this->add($arg1, $arg2);
            case '-':
                return $this->subtract($arg1, $arg2);
            case '*':
                return $this->multiply($arg1, $arg2);
            case '/':
                return $this->divide($arg1, $arg2);
        }

        throw new \Exception('Calculation Not supported');
    }

}
