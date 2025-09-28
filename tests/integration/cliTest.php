<?php
declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;

final class cliTest extends TestCase
{
    public function testWhenFilterResultsOnNoStringThenReturnsAllResults(): void
    {
        $expected =  <<<'EOF'
ID: 1 - Name: Blue Car
ID: 2 - Name: Speedy Bike
ID: 3 - Name: Red Car
ID: 4 - Name: Vintage Bike
ID: 5 - Name: Family Car
ID: 6 - Name: فان الأزرق
ID: 7 - Name: 北京极速
ID: 8 - Name: 東京スポーツカー
ID: 9 - Name: 서울 스쿠터
ID: 10 - Name: ताज परिवार

EOF;

        $output = shell_exec('php src/cli.php');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnEmptyStringThenReturnsAllResults(): void
    {
        $expected =  <<<'EOF'
ID: 1 - Name: Blue Car
ID: 2 - Name: Speedy Bike
ID: 3 - Name: Red Car
ID: 4 - Name: Vintage Bike
ID: 5 - Name: Family Car
ID: 6 - Name: فان الأزرق
ID: 7 - Name: 北京极速
ID: 8 - Name: 東京スポーツカー
ID: 9 - Name: 서울 스쿠터
ID: 10 - Name: ताज परिवार

EOF;

        $output = shell_exec('php src/cli.php ""');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnCarStringThenReturnsCarResults(): void
    {
        $expected =  <<<'EOF'
ID: 1 - Name: Blue Car
ID: 3 - Name: Red Car
ID: 5 - Name: Family Car

EOF;

        $output = shell_exec('php src/cli.php Car');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnCarroStringThenReturnsCarResults(): void
    {
        $expected =  <<<'EOF'
ID: 1 - Name: Blue Car
ID: 3 - Name: Red Car
ID: 5 - Name: Family Car

EOF;

        $output = shell_exec('php src/cli.php Carro');

        self::assertEquals($expected, $output);
    }
}