<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\VehicleController;
use App\Model\VehicleRepository;

$vehicleRepository = new VehicleRepository();
$controller = new VehicleController($vehicleRepository);

$prefix = substr($argv[1] ?? '', 0, 3);
$controller->search($prefix);