<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @phpstan-import-type VehicleDatum from VehicleRepository
 */
final class VehicleFactory
{
    /**
     * @param VehicleDatum $vehicleDatum
     */
    public function createVehicle(array $vehicleDatum, Location $location): Vehicle
    {
        return match ($vehicleDatum['type']) {
            'car' => new Car(
                name: $vehicleDatum['name'],
                location: $location,
                doors: (int) $vehicleDatum['doors'],
                fuel: $vehicleDatum['fuel'],
            ),
            'motorbike' => new Motorbike(
                name: $vehicleDatum['name'],
                location: $location,
                engineCc: (int) $vehicleDatum['engine_cc'],
                hasTrunk: (bool) $vehicleDatum['has_trunk'],
            ),
            default => throw new \InvalidArgumentException('Unknown vehicle type: ' . $vehicleDatum['type']),
        };
    }

}