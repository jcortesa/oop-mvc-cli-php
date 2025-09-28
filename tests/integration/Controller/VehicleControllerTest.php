<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Controller\VehicleController;
use PHPUnit\Framework\TestCase;
use App\Model\VehicleFactory;
use App\Model\VehicleRepository;
use App\View\ConsoleView;
use App\Controller\SearchTermValidator;
use App\Infrastructure\Logger;

final class VehicleControllerTest extends TestCase
{
    public function testWhenExceptionOccursThenErrorIsLogged(): void
    {
        $pdo = new \PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", getenv('DATABASE_HOST'), getenv('DATABASE_NAME')),
            getenv('DATABASE_USER'),
            getenv('DATABASE_PASSWORD')
        );

        $factory = new VehicleFactory();
        $repository = new VehicleRepository($pdo, $factory);
        $view = new ConsoleView();
        $searchTermValidator = new SearchTermValidator();
        $logger = new Logger();
        $controller = new VehicleController($repository, $view, $searchTermValidator, $logger);

        // Setup
        $logPath = __DIR__ . '/../../../logs/error.log';
        if (file_exists($logPath)) {
            unlink($logPath);
        }

        // Trigger an invalid search (more than 3 characters)
        $controller->search('VerylongSearchTerm');

        // Assert log file exists and contains error
        self::assertFileExists($logPath);
        $logContent = file_get_contents($logPath);
        self::assertStringContainsString('Search term cannot exceed 3 characters', $logContent);

        // Cleanup
        unlink($logPath);
    }
}