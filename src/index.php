<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\VehicleController;

$controller = new VehicleController();

$prefix = substr($argv[1] ?? '', 0, 3);
$controller->search($prefix);