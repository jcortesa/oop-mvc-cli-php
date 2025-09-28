<?php

declare(strict_types=1);

namespace App\View;

class ConsoleView {
    /**
     * @param list<Vehicle> $vehicles
     */
    public function render(array $vehicles): void
    {
        foreach ($vehicles as $item) {
            echo $item->description() . PHP_EOL;
        }
    }
}