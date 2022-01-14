<?php

namespace App\Entity;

class Calculator
{
    private float $entry = 0;
    private float $result = 0;

    public function getEntry(): float
    {
        return $this->entry;
    }

    public function setEntry(float $entry): self
    {
        $this->entry = $entry;

        return $this;
    }

    public function getResult(): float
    {
        return $this->result;
    }

    public function setResult(float $result): self
    {
        $this->result = $result;

        return $this;
    }
}
