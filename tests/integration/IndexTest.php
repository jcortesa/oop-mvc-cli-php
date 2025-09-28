<?php
declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;

final class IndexTest extends TestCase
{
    public function testWhenFilterResultsOnNoStringThenReturnsAllResults(): void
    {
        $expected =  <<<'EOF'
Blue Car, 5 doors, gasoline, Valencia, Valencia
Speedy Bike, 600cc, has trunk, Almería, Almería
Red Car, 3 doors, electric, Mojácar, Almería
Vintage Bike, 125cc, has no trunk, Sanlúcar, Cadiz
Family Car, 5 doors, diesel, Málaga, Málaga
فان الأزرق, 4 doors, gasoline, Dubai, United Arab Emirates
北京极速, 600cc, has trunk, Beijing, China
東京スポーツカー, 2 doors, electric, Tokyo, Japan
서울 스쿠터, 125cc, has no trunk, Seoul, South Korea
ताज परिवार, 4 doors, diesel, Mumbai, India

EOF;

        $output = shell_exec('php src/Index.php');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnEmptyStringThenReturnsAllResults(): void
    {
        $expected =  <<<'EOF'
Blue Car, 5 doors, gasoline, Valencia, Valencia
Speedy Bike, 600cc, has trunk, Almería, Almería
Red Car, 3 doors, electric, Mojácar, Almería
Vintage Bike, 125cc, has no trunk, Sanlúcar, Cadiz
Family Car, 5 doors, diesel, Málaga, Málaga
فان الأزرق, 4 doors, gasoline, Dubai, United Arab Emirates
北京极速, 600cc, has trunk, Beijing, China
東京スポーツカー, 2 doors, electric, Tokyo, Japan
서울 스쿠터, 125cc, has no trunk, Seoul, South Korea
ताज परिवार, 4 doors, diesel, Mumbai, India

EOF;

        $output = shell_exec('php src/Index.php ""');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnCarStringThenReturnsCarResults(): void
    {
        $expected =  <<<'EOF'
Blue Car, 5 doors, gasoline, Valencia, Valencia
Red Car, 3 doors, electric, Mojácar, Almería
Family Car, 5 doors, diesel, Málaga, Málaga

EOF;

        $output = shell_exec('php src/Index.php Car');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnCarroStringThenReturnsCarResults(): void
    {
        $expected =  <<<'EOF'
Blue Car, 5 doors, gasoline, Valencia, Valencia
Red Car, 3 doors, electric, Mojácar, Almería
Family Car, 5 doors, diesel, Málaga, Málaga

EOF;

        $output = shell_exec('php src/Index.php Carro');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnBlueStringThenReturnsBluResultsFormatedAsExpected(): void
    {
        $expected =  <<<'EOF'
Blue Car, 5 doors, gasoline, Valencia, Valencia

EOF;

        $output = shell_exec('php src/Index.php Blue');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnSpeedyStringThenReturnsSpeResultsFormatedAsExpected(): void
    {
        $expected =  <<<'EOF'
Speedy Bike, 600cc, has trunk, Almería, Almería

EOF;

        $output = shell_exec('php src/Index.php Speedy');

        self::assertEquals($expected, $output);
    }

    public function testWhenFilterResultsOnVintageStringThenReturnsVinResultsFormatedAsExpected(): void
    {
        $expected =  <<<'EOF'
Vintage Bike, 125cc, has no trunk, Sanlúcar, Cadiz

EOF;

        $output = shell_exec('php src/Index.php Vintage');

        self::assertEquals($expected, $output);
    }
}