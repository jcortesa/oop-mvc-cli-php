<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use PDOException;

/**
 * @phpstan-type VehicleDatum array{
 *     name: string,
 *     city: string,
 *     state: string,
 *     type: string,
 *     doors: string|null,
 *     fuel: string|null,
 *     engine_cc: string|null,
 *     has_trunk: string|null,
 * }
 */
final class VehicleRepository {
    public function __construct(private PDO $pdo, private VehicleFactory $vehicleFactory)
    {
    }

    /**
     * @return list<Vehicle>
     */
    public function getVehiclesByNameFilter(string $nameFilter): array
    {
        try {
            $stmt = $this->pdo->prepare(<<<EOF
                SELECT vehicles.name, locations.city, locations.state, 
                       cars.doors, cars.fuel, 
                       motorbikes.engine_cc, motorbikes.has_trunk, vehicles.type
                FROM vehicles
                LEFT JOIN cars ON cars.vehicle_id = vehicles.id
                LEFT JOIN motorbikes ON motorbikes.vehicle_id = vehicles.id
                INNER JOIN locations ON locations.id = vehicles.location_id
                WHERE vehicles.NAME LIKE :nameFilter
            EOF);

            $stmt->execute(['nameFilter' => '%'.$nameFilter.'%']);

            /** @var list<VehicleDatum> $rows */
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $location = new Location($row['city'], $row['state']);
                $results[] = $this->vehicleFactory->createVehicle($row, $location);
            }

            return $results;
        } catch (PDOException $e) {
            throw VehicleRepositoryException::fromPDOException($e);
        }
    }
}
