<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\Car;
use App\Model\Location;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Car
 */
final class CarTest extends TestCase
{
    public function testWhenDescriptionThenReturnsExpectedString(): void
    {
        $expected = 'Toyota Camry, 4 doors, gasoline, Los Angeles, CA';
        $location = new Location('Los Angeles', 'CA');
        $car = new Car('Toyota Camry', $location, 4, 'gasoline');

        $result = $car->description();

        self::assertSame($expected, $result);
    }
}