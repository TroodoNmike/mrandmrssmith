<?php

namespace App\Service;

interface StorageInterface
{
    public function get(): float;
    public function save(float $num): void;
    public function reset(): void;
}
