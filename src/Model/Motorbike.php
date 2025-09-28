<?php

declare(strict_types=1);

namespace App\Model;

readonly class Motorbike extends Vehicle
{
    public function __construct(string $name, Location $location, public int $engineCc, public bool $hasTrunk)
    {
        parent::__construct($name, $location);
    }
}