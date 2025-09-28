<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\VehicleFactory
 */
final class VehicleFactoryTest extends TestCase
{
    public function testWhenCreateVehicleOnCarTypeThenReturnsCar(): void
    {
        self::markTestIncomplete('To be implemented');
    }

    public function testWhenCreateVehicleOnMotorbikeTypeThenReturnsMotorbike(): void
    {
        self::markTestIncomplete('To be implemented');
    }

    public function testWhenCreateVehicleOnUnknownTypeThenThrowsInvalidArgumentException(): void
    {
        self::markTestIncomplete('To be implemented');
    }
}