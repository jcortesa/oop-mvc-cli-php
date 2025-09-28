<?php
declare(strict_types=1);

namespace App\Infrastructure;

interface LoggerInterface {
    public function error(\Throwable $error): void;
}