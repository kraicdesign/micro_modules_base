<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\DataMapper\Types;

/**
 * Type that maps an integer value
 */
class IntegerType implements TypeInterface
{
    public function convertToStorageValue(mixed $value): int
    {
        return (int) $value;
    }

    public function convertFromStorageValue(mixed $value): int
    {
        return (int) $value;
    }
}
