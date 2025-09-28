<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class cliTest extends TestCase
{
    public function testCliOutput(): void
    {
        $output = shell_exec('php src/cli.php World');

        self::assertEquals("Hello from CLI: World\n", $output);
    }
}