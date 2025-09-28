<?php

declare(strict_types=1);

namespace App\Infrastructure;

final class Logger implements LoggerInterface
{
    private const string LOG_PATH = __DIR__ . '/../../logs/';
    private const string ERROR_LOG = 'error.log';

    public function __construct()
    {
        if (
            !is_dir(self::LOG_PATH) &&
            !mkdir($concurrentDirectory = self::LOG_PATH, 0755, true) &&
            !is_dir($concurrentDirectory)
        ) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
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