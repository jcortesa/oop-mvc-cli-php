<?php

declare(strict_types=1);

namespace Tests\unit\Model;

use App\Model\Location;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Location
 */
final class LocationTest extends TestCase
{
    public function testWhenConstructThenReturnsLocationWithExpectedProperties(): void
    {
        $location = new Location('Los Angeles', 'CA');

        self::assertSame('Los Angeles', $location->city);
        self::assertSame('CA', $location->state);
    }
}