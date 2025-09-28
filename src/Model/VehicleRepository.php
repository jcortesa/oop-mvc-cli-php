<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use PDOException;

class VehicleRepository {
    public function __construct()
    {
    }

    public function getVehiclesByNameFilter(string $nameFilter): array
    {
        try {
            // @TODO separate db connection configuration from code
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=utf8mb4",
                getenv('DATABASE_HOST') ?: 'localhost',
                getenv('DATABASE_NAME')
            );

            $pdo = new PDO($dsn, getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // @TODO use prepared statements to avoid SQL injection
            $nameFilter = substr($nameFilter, 0, 3);

            // @TODO separate query into a repository class
            $stmt = $pdo->query(<<<EOF
                SELECT vehicles.name, locations.city, locations.state, 
                       cars.doors, cars.fuel, 
                       motorbikes.engine_cc, motorbikes.has_trunk
                FROM vehicles
                LEFT JOIN cars ON cars.vehicle_id = vehicles.id
                LEFT JOIN motorbikes ON motorbikes.vehicle_id = vehicles.id
                INNER JOIN locations ON locations.id = vehicles.location_id
                WHERE vehicles.NAME LIKE '%$nameFilter%'
            EOF
            );

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // @TODO handle errors more gracefully
            die("Connection failed: " . $e->getMessage());
        }
    }
}
