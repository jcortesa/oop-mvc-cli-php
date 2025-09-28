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


    // @TODO use only 3 first characters to filter
    $nameFilter = $argv[1] ?? '';
    $stmt = $pdo->query("SELECT * FROM vehicles WHERE NAME LIKE '%$nameFilter%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        echo "ID: " . $row['id'] . " - Name: " . $row['name'] . "\n";
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}