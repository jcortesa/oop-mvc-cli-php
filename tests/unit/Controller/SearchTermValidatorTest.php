<?php

declare(strict_types=1);

namespace Tests\unit\Controller;

use App\Controller\SearchTermValidator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Controller\SearchTermValidator
 */
final class SearchTermValidatorTest extends TestCase
{
    public function testWhenValidateOnTooLargeTermThenThrowsInvalidArgumentException(): void
    {
        $searchTermValidator = new SearchTermValidator();

        $this->expectException(\InvalidArgumentException::class);

        $searchTermValidator->validate('Too Long Term');
    }

    public function testWhenValidateOnNoValidationErrorThenReturnsTerm(): void
    {
        $searchTermValidator = new SearchTermValidator();

        $result = $searchTermValidator->validate('Spe');

        self::assertSame('Spe', $result);
    }
}