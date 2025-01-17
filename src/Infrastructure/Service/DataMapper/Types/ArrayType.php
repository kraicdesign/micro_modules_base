<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\DataMapper\Types;

use DddModule\Base\Infrastructure\Service\DataMapper\Exception\SourceValueIsInvalidException;

/**
 * Type that maps an array value
 */
class ArrayType implements TypeInterface
{
    public function convertToStorageValue(mixed $value): string
    {
        if (! is_array($value)) {
            throw SourceValueIsInvalidException::fromParameters(self::class, "array", gettype($value));
        }

        return "{" . implode(",", $value) . "}";
    }

    public function convertFromStorageValue(mixed $value): array
    {
        if (! is_string($value)) {
            throw SourceValueIsInvalidException::fromParameters(self::class, "string", gettype($value));
        }

        $convertedToJsonValue = strtr($value, [
            "{" => "[",
            "}" => "]",
        ]);

        return (array) json_decode($convertedToJsonValue, true, 512, JSON_THROW_ON_ERROR);
    }
}
