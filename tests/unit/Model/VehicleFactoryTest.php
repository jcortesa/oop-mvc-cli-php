<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\Car;
use App\Model\Location;
use App\Model\Motorbike;
use App\Model\VehicleFactory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\VehicleFactory
 */
final class VehicleFactoryTest extends TestCase
{
    public function testWhenCreateVehicleOnCarTypeThenReturnsCar(): void
    {
        $factory = new VehicleFactory();
        $location = new Location('Los Angeles', 'CA');
        $data = [
            'type' => 'car',
            'name' => 'Toyota Camry',
            'doors' => 4,
            'fuel' => 'gasoline',
        ];

        $vehicle = $factory->createVehicle($data, $location);

        self::assertInstanceOf(Car::class, $vehicle);
    }

    public function testWhenCreateVehicleOnMotorbikeTypeThenReturnsMotorbike(): void
    {
        $factory = new VehicleFactory();
        $location = new Location('Los Angeles', 'CA');
        $data = [
            'type' => 'motorbike',
            'name' => 'Harley Davidson',
            'engine_cc' => 750,
            'has_trunk' => true,
        ];

        $vehicle = $factory->createVehicle($data, $location);

        self::assertInstanceOf(Motorbike::class, $vehicle);
    }

    public function testWhenCreateVehicleOnUnknownTypeThenThrowsInvalidArgumentException(): void
    {
        $factory = new VehicleFactory();
        $location = new Location('New New York', 'Mars');
        $data = [
            'type' => 'UFO',
            'name' => 'flying saucer',
        ];

        $this->expectException(\InvalidArgumentException::class);

        $factory->createVehicle($data, $location);
    }
}