<?php

declare(strict_types=1);

namespace App\Controller;

final class SearchTermValidator
{
    private const int MAX_LENGTH = 3;

    /**
     * @throws \InvalidArgumentException
     */
    public function validate(string $term): string
    {
        $term = trim($term);

        if (strlen($term) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Search term cannot exceed ' . self::MAX_LENGTH . ' characters');
        }

        return $term;
    }
}