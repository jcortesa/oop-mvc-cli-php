<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\VehicleFactory;
use App\Model\VehicleRepository;
use App\Model\VehicleRepositoryException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\VehicleRepository
 */
final class VehicleRepositoryTest extends TestCase
{
    public function testWhenGetVehiclesByNameFilterOnErrorThenThrowsVehicleRepositoryException(): void
    {
        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock->method('prepare')->willThrowException(new \PDOException('Test exception'));
        $vehicleFactory = new VehicleFactory();
        $repository = new VehicleRepository($pdoMock, $vehicleFactory);

        $this->expectException(VehicleRepositoryException::class);

        $repository->getVehiclesByNameFilter('test');
    }

    public function testWhenGetVehiclesByNameFilterOnNoErrorThenReturnsResult(): void
    {
        $pdoMock = $this->createMock(\PDO::class);
        $pdoMock
            ->method('prepare')
            ->willReturn($this->createMock(\PDOStatement::class));
        $vehicleFactory = new VehicleFactory();
        $repository = new VehicleRepository($pdoMock, $vehicleFactory);

        $result = $repository->getVehiclesByNameFilter('test');

        self::assertSame([], $result);
    }
}