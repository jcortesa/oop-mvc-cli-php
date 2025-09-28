<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\VehicleRepository;
use App\View\ConsoleView;

final class VehicleController
{
    public function __construct(private VehicleRepository $vehicleRepository, private ConsoleView $consoleView)
    {
    }

    public function search(string $nameFilter): void
    {
        // @TODO validate input
        // @TODO catch possible exceptions
        $vehicles = $this->vehicleRepository->getVehiclesByNameFilter($nameFilter);

        $this->consoleView->render($vehicles);
    }
}