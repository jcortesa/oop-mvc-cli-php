<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\SearchTermValidator;
use App\Controller\VehicleController;
use App\Model\VehicleFactory;
use App\Model\VehicleRepository;
use App\View\ConsoleView;

const INPUT_CHARS_LIMIT = 3;

$pdo = new PDO(
    sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", getenv('DATABASE_HOST'), getenv('DATABASE_NAME')),
    getenv('DATABASE_USER'),
    getenv('DATABASE_PASSWORD')
);

$factory = new VehicleFactory();
$repository = new VehicleRepository($pdo, $factory);
$view = new ConsoleView();
$searchTermValidator = new SearchTermValidator();
$controller = new VehicleController($repository, $view, $searchTermValidator);

$prefix = substr($argv[1] ?? '', 0, INPUT_CHARS_LIMIT);
$controller->search($prefix);