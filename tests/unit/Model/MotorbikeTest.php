<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\Location;
use App\Model\Motorbike;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Motorbike
 */
final class MotorbikeTest extends TestCase
{
    public function testWhenDescriptionThenReturnsExpectedString(): void
    {
        $expected = 'Harley Davidson, 750cc, has trunk, Miami, FL';
        $location = new Location('Miami', 'FL');
        $motorbike = new Motorbike('Harley Davidson', $location, 750, true);

        $result = $motorbike->description();

        self::assertSame($expected, $result);
    }
}