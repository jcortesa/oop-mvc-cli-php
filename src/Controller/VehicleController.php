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
        $vehicles = $this->vehicleRepository->getVehiclesByNameFilter($nameFilter);

        // @TODO separate presentation code
        foreach ($vehicles as $vehicle) {
            if ($vehicle instanceof \App\Model\Car) {
                $detail1 = "{$vehicle->doors} doors";
                $detail2 = $vehicle->fuel;
            } else {
                $detail1 = "{$vehicle->engineCc}cc";
                $detail2 = $vehicle->hasTrunk ? 'has trunk' : 'has no trunk';
            }

            echo "$vehicle->name, {$detail1}, {$detail2}, {$vehicle->location->city}, {$vehicle->location->state}\n";
        }
    }
}