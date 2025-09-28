<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\VehicleRepository;
use App\Model\VehicleRepositoryException;
use App\View\ConsoleView;

final class VehicleController
{
    public function __construct(private VehicleRepository $vehicleRepository, private ConsoleView $consoleView)
    {
    }

    public function search(string $nameFilter): void
    {
        // @TODO validate input
        try {
            $vehicles = $this->vehicleRepository->getVehiclesByNameFilter($nameFilter);
        } catch (VehicleRepositoryException $e) {
            // @TODO log error
            echo 'An error occurred while fetching vehicles. Please try again later.' . PHP_EOL;

            return;
        }

        $this->consoleView->render($vehicles);
    }
}