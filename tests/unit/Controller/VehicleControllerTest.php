<?php

declare(strict_types=1);

namespace Tests\unit\Controller;

use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Controller\VehicleController
 */
final class VehicleControllerTest extends TestCase
{
    public function testWhenSearchOnInvalidTermThenErrorIsLoggedAndMessageShown(): void
    {
        self::markTestIncomplete('To be implemented');
    }

    public function testWhenSearchOnErrorWhileFetchingVehiclesThenErrorIsLoggedAndMessageShown(): void
    {
        self::markTestIncomplete('To be implemented');
    }

    public function testWhenSearchOnValidTermThenVehiclesAreRendered(): void
    {
        self::markTestIncomplete('To be implemented');
    }
}