<?php

declare(strict_types=1);

namespace App\Model;

final class VehicleRepositoryException extends \RuntimeException
{
    public static function fromPDOException(\PDOException $e): self
    {
        return new self('An error occurred while accessing the vehicle repository.', previous: $e);
    }
}