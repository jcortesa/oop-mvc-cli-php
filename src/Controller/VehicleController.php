<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Logger;
use App\Model\VehicleRepository;
use App\Model\VehicleRepositoryException;
use App\View\ConsoleView;

final class VehicleController
{
    public function __construct(
        private VehicleRepository $vehicleRepository,
        private ConsoleView $consoleView,
        private SearchTermValidator $searchTermValidator,
        private Logger $logger
    ){}

    public function search(string $nameFilter): void
    {
        try {
            $validatedFilter = $this->searchTermValidator->validate($nameFilter);
        } catch (\InvalidArgumentException $e) {
            $this->logger->error($e);
            echo 'Invalid search term. Please use a maximum length of 3 characters.' . PHP_EOL;

            return;
        }

        try {
            $vehicles = $this->vehicleRepository->getVehiclesByNameFilter($validatedFilter);
        } catch (VehicleRepositoryException $e) {
            $this->logger->error($e);
            echo 'An error occurred while fetching vehicles. Please try again later.' . PHP_EOL;

            return;
        }

        $this->consoleView->render($vehicles);
    }
}