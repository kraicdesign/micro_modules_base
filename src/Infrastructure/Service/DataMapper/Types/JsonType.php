<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\DataMapper\Types;

use DddModule\Base\Infrastructure\Service\DataMapper\Exception\SourceValueIsInvalidException;

/**
 * Type that maps a json value
 */
class JsonType implements TypeInterface
{
    public function convertToStorageValue(mixed $value): string
    {
        if (is_array($value) === false) {
            throw SourceValueIsInvalidException::fromParameters(self::class, "array", gettype($value));
        }

        return (string) json_encode($value, JSON_THROW_ON_ERROR);
    }

    public function convertFromStorageValue(mixed $value): array
    {
        return (array) json_decode((string) $value, true, 512, JSON_THROW_ON_ERROR);
    }
}
