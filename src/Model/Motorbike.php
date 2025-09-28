<?php

declare(strict_types=1);

namespace App\Model;

final readonly class Motorbike extends Vehicle
{
    public function __construct(string $name, Location $location, public int $engineCc, public bool $hasTrunk)
    {
        parent::__construct($name, $location);
    }

    public function description(): string
    {
        $trunkDescription = $this->hasTrunk ? 'has trunk' : 'has no trunk';

        return "{$this->name}, {$this->engineCc}cc, {$trunkDescription}, {$this->location->city}, {$this->location->state}";
    }
}