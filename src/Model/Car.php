<?php

declare(strict_types=1);

namespace App\Model;

readonly class Car extends Vehicle
{
    public function __construct(string $name, Location $location, public int $doors, public string $fuel)
    {
        parent::__construct($name, $location);
    }
}