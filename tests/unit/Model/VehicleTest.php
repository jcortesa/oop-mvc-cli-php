<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\Location;
use App\Model\Vehicle;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Vehicle
 */
final class VehicleTest extends TestCase
{
    public function testWhenDescriptionThenReturnsExpectedString(): void
    {
        $class = new readonly class('Test Vehicle', new Location('Los Angeles', 'CA')) extends Vehicle {
            public function description(): string
            {
                return $this->name;
            }
        };

        $result = $class->description();

        self::assertSame('Test Vehicle', $result);
    }
}