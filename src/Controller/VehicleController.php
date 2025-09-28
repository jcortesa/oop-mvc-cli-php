<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\VehicleRepository;

final class VehicleController
{
    public function __construct(private VehicleRepository $vehicleRepository)
    {
        mb_internal_encoding('UTF-8');
        ini_set('default_charset', 'UTF-8');
    }

    public function search(string $nameFilter): void
    {
        // @TODO catch possible exceptions
        $results = $this->vehicleRepository->getVehiclesByNameFilter($nameFilter);

        // @TODO separate presentation code
        foreach ($results as $row) {
            $detail1 = isset($row['doors'])
                ? "{$row['doors']} doors"
                : "{$row['engine_cc']}cc";

            $detail2 = isset($row['fuel'])
                ? $row['fuel']
                : ($row['has_trunk'] === 1 ? "has trunk" : "has no trunk");

            echo "{$row['name']}, {$detail1}, {$detail2}, {$row['city']}, {$row['state']}\n";
        }
    }
}