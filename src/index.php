<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\VehicleController;
use App\Model\VehicleRepository;
use App\View\ConsoleView;

$vehicleRepository = new VehicleRepository();
$consoleView = new ConsoleView();
$controller = new VehicleController($vehicleRepository, $consoleView);

$prefix = substr($argv[1] ?? '', 0, 3);
$controller->search($prefix);