<?php

declare(strict_types=1);

namespace Tests\unit\Controller;

use App\Controller\SearchTermValidator;
use App\Controller\VehicleController;
use App\Infrastructure\LoggerInterface;
use App\Model\Car;
use App\Model\Location;
use App\Model\Motorbike;
use App\Model\VehicleRepository;
use App\Model\VehicleRepositoryException;
use App\View\ConsoleView;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Controller\VehicleController
 */
final class VehicleControllerTest extends TestCase
{
    public function testWhenSearchOnInvalidTermThenErrorIsLoggedAndMessageShown(): void
    {
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
            ->method('error')
            ->with($this->isInstanceOf(\InvalidArgumentException::class));
        $vehicleController = new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);

        ob_start();
        $vehicleController->search('invalid-term');
        $output = ob_get_clean();

        self::assertSame('Invalid search term. Please use a maximum length of 3 characters.'.PHP_EOL, $output);
    }

    public function testWhenSearchOnErrorWhileFetchingVehiclesThenErrorIsLoggedAndMessageShown(): void
    {
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willThrowException(VehicleRepositoryException::fromPDOException(new \PDOException()));
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
            ->method('error')
            ->with($this->isInstanceOf(VehicleRepositoryException::class));
        $vehicleController = new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);

        ob_start();
        $vehicleController->search('ter');
        $output = ob_get_clean();

        self::assertSame('An error occurred while fetching vehicles. Please try again later.'.PHP_EOL, $output);
    }

    public function testWhenSearchOnValidTermAndNoResultsThenEmptyStringIsRendered(): void
    {
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willReturn([]);
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);
        $vehicleController = new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);

        ob_start();
        $vehicleController->search('ter');
        $output = ob_get_clean();

        self::assertSame('', $output);
    }

    public function testWhenSearchOnValidTermAndResultsThenRendersResults(): void
    {
        $expected = <<<OUTPUT
Test Car, 4 doors, petrol, Test City, TS
Another Car, 2 doors, diesel, Another City, AC
Test Bike, 600cc, has trunk, Bike City, BC

OUTPUT;
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willReturn([
                new Car('Test Car', new Location('Test City', 'TS'), 4, 'petrol'),
                new Car('Another Car', new Location('Another City', 'AC'), 2, 'diesel'),
                new Motorbike('Test Bike', new Location('Bike City', 'BC'), 600, true),
            ]);
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);
        $vehicleController = new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);

        ob_start();
        $vehicleController->search('ter');
        $output = ob_get_clean();

        self::assertSame($expected, $output);
    }

    public function testWhenSearchOnValidTermWithSpecialCharsAndResultsThenRendersResults(): void
    {
        $expected = <<<OUTPUT
北京极速, 600cc, has trunk, Beijing, China

OUTPUT;
        $vehicleRepositoryMock = $this->createMock(VehicleRepository::class);
        $vehicleRepositoryMock->method('getVehiclesByNameFilter')
            ->willReturn([
                new Motorbike('北京极速', new Location('Beijing', 'China'), 600, true),
            ]);
        $consoleView = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $loggerMock = $this->createMock(LoggerInterface::class);
        $vehicleController = new VehicleController($vehicleRepositoryMock, $consoleView, $searchTermValidator, $loggerMock);

        ob_start();
        $vehicleController->search('ter');
        $output = ob_get_clean();

        self::assertSame($expected, $output);
    }
}