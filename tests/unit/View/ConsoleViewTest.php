<?php

declare(strict_types=1);

namespace Tests\unit\View;

use App\Model\Car;
use App\Model\Location;
use App\Model\Motorbike;
use App\View\ConsoleView;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\View\ConsoleView
 */
final class ConsoleViewTest extends TestCase
{
    public function testWhenRenderOnEmptyListOfVehiclesThenOutputsExpectedString(): void
    {
        $vehiclesData = [];
        $consoleView = new ConsoleView();

        ob_start();
        $consoleView->render($vehiclesData);
        $result = ob_get_clean();

        self::assertSame('', $result);
    }

    public function testWhenRenderOnNonEmptyListOfVehiclesThenOutputsExpectedString(): void
    {
        $expected = <<<'EOF'
Car1, 5 doors, diesel, City1, State1
Motorbike1, 125cc, has no trunk, City2, State2

EOF;
        $vehicles = [
            new Car('Car1', new Location('City1', 'State1'), 5, 'diesel'),
            new Motorbike('Motorbike1', new Location('City2', 'State2'), 125, false),
        ];
        $consoleView = new ConsoleView();

        ob_start();
        $consoleView->render($vehicles);
        $result = ob_get_clean();

        self::assertSame($expected, $result);
    }
}