<?php

declare(strict_types=1);

namespace App\Model;

abstract readonly class Vehicle
{
    public function __construct(public string $name, public Location $location)
    {
    }

    abstract public function description(): string;
}