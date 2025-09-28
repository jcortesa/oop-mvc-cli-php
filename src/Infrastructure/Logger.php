<?php

declare(strict_types=1);

namespace App\Infrastructure;

final class Logger
{
    private const LOG_PATH = __DIR__ . '/../../logs/';
    private const ERROR_LOG = 'error.log';

    public function __construct()
    {
        if (!is_dir(self::LOG_PATH)) {
            mkdir(self::LOG_PATH, 0755, true);
        }
    }

    public function error(\Throwable $error): void
    {
        $message = sprintf(
            "[%s] %s in %s:%d\nStack trace:\n%s\n",
            date('Y-m-d H:i:s'),
            $error->getMessage(),
            $error->getFile(),
            $error->getLine(),
            $error->getTraceAsString()
        );

        error_log($message, 3, self::LOG_PATH . self::ERROR_LOG);
    }
}