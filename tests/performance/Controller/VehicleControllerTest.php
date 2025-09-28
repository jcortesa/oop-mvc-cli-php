<?php

declare(strict_types=1);

namespace Tests\performance\Controller;

use App\Controller\VehicleController;
use App\Infrastructure\LoggerInterface;
use App\Model\Car;
use App\Model\Location;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\Model\VehicleFactory;
use App\Model\VehicleRepository;
use App\View\ConsoleView;
use App\Controller\SearchTermValidator;
use App\Infrastructure\Logger;

/**
 * Performance test suite for VehicleController
 * @group performance
 */
class VehicleControllerTest extends TestCase
{
    private const int LARGE_DATASET_SIZE = 10000000;

    protected function setUp(): void
    {
        parent::setUp();
        // Set memory limit and execution time for performance tests
        ini_set('memory_limit', '256M');
        set_time_limit(60);
    }

    /**
     * Tests search performance with a large dataset
     * Ensures search execution time stays within acceptable limits
     */
    public function testSearchPerformanceWithLargeDataset(): void
    {
        $vehicles = $this->generateLargeVehicleDataset();
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willReturn($vehicles);

        $controller = $this->createVehicleController($vehicleRepositoryMock);

        $startTime = microtime(true);
        ob_start();
        $controller->search('tes');
        ob_get_clean();
        $executionTime = microtime(true) - $startTime;

        // Search should complete within 500ms
        self::assertLessThan(0.5, $executionTime);
    }

    /**
     * Tests memory usage during search operation
     * Ensures memory consumption stays within acceptable limits
     */
    public function testSearchMemoryUsage(): void
    {
        $vehicles = $this->generateLargeVehicleDataset();
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willReturn($vehicles);

        $controller = $this->createVehicleController($vehicleRepositoryMock);

        $memoryBefore = memory_get_usage();
        ob_start();
        $controller->search('tes');
        ob_get_clean();
        $memoryAfter = memory_get_usage();

        // Memory increase should not exceed 10MB
        $memoryIncrease = ($memoryAfter - $memoryBefore) / 1024 / 1024;
        self::assertLessThan(10, $memoryIncrease);
    }

    private function generateLargeVehicleDataset(): array
    {
        $vehicles = [];
        for ($i = 0; $i < self::LARGE_DATASET_SIZE; $i++) {
            $vehicles[] = new Car(
                "Test Car $i",
                new Location("City $i", "TC"),
                4,
                'petrol'
            );
        }
        return $vehicles;
    }

    private function createVehicleController(VehicleRepository|MockObject $vehicleRepositoryMock): VehicleController
    {
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);

        return new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);
    }
}