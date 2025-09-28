<?php

declare(strict_types=1);

namespace Tests\unit\Controller;

use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Controller\SearchTermValidator
 */
final class SearchTermValidatorTest extends TestCase
{
    public function testWhenValidateOnTooLargeTermThenThrowsInvalidArgumentException(): void
    {
        self::markTestIncomplete('To be implemented');
    }

    public function testWhenValidateOnNoValidationErrorThenReturnsTerm(): void
    {
        self::markTestIncomplete('To be implemented');
    }
}