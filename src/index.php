<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\VehicleController;
use App\Model\VehicleRepository;
use App\View\ConsoleView;

const INPUT_CHARS_LIMIT = 3;

$pdo = new PDO(
    sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", getenv('DATABASE_HOST'), getenv('DATABASE_NAME')),
    getenv('DATABASE_USER'),
    getenv('DATABASE_PASSWORD')
);

$repository = new VehicleRepository($pdo);
$view = new ConsoleView();
$controller = new VehicleController($repository, $view);

$prefix = substr($argv[1] ?? '', 0, INPUT_CHARS_LIMIT);
$controller->search($prefix);