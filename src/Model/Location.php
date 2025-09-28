<?php

declare(strict_types=1);

namespace App\Model;

final readonly class Location
{
    public function __construct(public string $city, public string $state)
    {
    }
}