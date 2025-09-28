<?php
declare(strict_types=1);

namespace App;

use PDO;
use PDOException;

mb_internal_encoding('UTF-8');
ini_set('default_charset', 'UTF-8');

try {
    $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4",
        getenv('DATABASE_HOST') ?: 'localhost',
        getenv('DATABASE_NAME')
    );

    $pdo = new PDO($dsn, getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nameFilter = substr($argv[1] ?? '', 0, 3);
    $stmt = $pdo->query(<<<EOF
SELECT vehicles.name, locations.city, locations.state, cars.doors, cars.fuel, motorbikes.engine_cc, motorbikes.has_trunk
FROM vehicles 
LEFT JOIN cars ON cars.vehicle_id = vehicles.id
LEFT JOIN motorbikes ON motorbikes.vehicle_id = vehicles.id
INNER JOIN locations ON locations.id = vehicles.location_id
WHERE vehicles.NAME LIKE '%$nameFilter%'
EOF
);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        $detail1 = isset($row['doors']) ? "{$row['doors']} doors" : "{$row['engine_cc']}cc";
        $detail2 = isset($row['fuel']) ? "{$row['fuel']}" : (1 === $row['has_trunk'] ? "has trunk" : "has no trunk");

        echo "{$row['name']}, {$detail1}, {$detail2}, {$row['city']}, {$row['state']}\n";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}