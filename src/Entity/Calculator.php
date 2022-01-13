<?php

namespace App\Entity;

class Calculator
{
    private $first;

    private $second;

    public function getFirst(): ?float
    {
        return $this->first;
    }

    public function setFirst(float $first): self
    {
        $this->first = $first;

        return $this;
    }

    public function getSecond(): ?float
    {
        return $this->second;
    }

    public function setSecond(float $second): self
    {
        $this->second = $second;

        return $this;
    }
}
