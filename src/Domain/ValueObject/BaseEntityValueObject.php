<?php

namespace MicroModule\Base\Domain\ValueObject;

use Broadway\Serializer\Serializable;
use MicroModule\Base\Domain\Exception\ValueObjectInvalidException;
use MicroModule\Base\Domain\Exception\ValueObjectInvalidNativeValueException;
use MicroModule\ValueObject\ValueObjectInterface;

abstract class BaseEntityValueObject implements  Serializable, ValueObjectInterface
{
    public const KEY_UUID = "uuid";

    public const KEY_PROCESS_UUID = "process_uuid";

    public const KEY_PAYLOAD = "payload";


    /**
     * Return Payload value object.
     */
    protected ?Payload $payload = null;

    public function getPayload(): ?Payload
    {
        return $this->payload;
    }

    /**
     * Make Bet from DTO object or serialized string.
     */
    public static function fromNative(): static
    {
        $data = func_get_arg(0);
        $payload = null;

        if (is_array($data)) {
            if (isset($data[self::KEY_PAYLOAD])) {
                $payload = Payload::fromNative($data[self::KEY_PAYLOAD]);
            }
            $valueObject = static::fromArray($data);
            $valueObject->payload = $payload;

            return $valueObject;
        }

        if (is_string($data)) {
            $data = unserialize($data, ["allowed_classes" => false]);
            if (isset($data[self::KEY_PAYLOAD])) {
                $payload = Payload::fromNative($data[self::KEY_PAYLOAD]);
            }
            $valueObject = static::fromArray($data);
            $valueObject->payload = $payload;

            return $valueObject;
        }

        throw new ValueObjectInvalidNativeValueException("Invalid native value");
    }

    /**
     * Tells whether two Collection are equal by comparing their size.
     *
     * @throws ValueObjectInvalidException
     */
    public function sameValueAs(ValueObjectInterface $valueObject): bool
    {
        if (!$valueObject instanceof static) {
            return false;
        }

        foreach (static::COMPARED_FIELDS as $field) {
            $getMethodName = "get" . ucfirst($field);
            $field = $this->{$getMethodName}();
            $property = $valueObject->{$getMethodName}();

            if (null === $field && null === $property) {
                continue;
            }

            if (null === $field || null === $property) {
                return false;
            }

            if (
                !$field instanceof ValueObjectInterface ||
                !$property instanceof ValueObjectInterface
            ) {
                throw new ValueObjectInvalidException("Some of value not instance of \"ValueObjectInterface\"");
            }

            if (!$field->sameValueAs($property)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return native value.
     *
     * @return mixed[]
     */
    public function toNative()
    {
        return $this->toArray();
    }

    /**
     * Returns a native string representation of the Collection object.
     */
    public function __toString(): string
    {
        return serialize($this->toArray());
    }

    /**
     * Convert array to ValueObject.
     *
     * @param mixed[] $data
     */
    public static function deserialize(array $data): self
    {
        return static::fromNative($data);
    }

    /**
     * Convert ValueObject to array.
     *
     * @return mixed[]
     */
    public function serialize(): array
    {
        return $this->toNative();
    }

    /**
     * Enrich entity data with payload
     */
    protected function enrich(array $data): array
    {
        if ($this->payload) {
            $data[self::KEY_PAYLOAD] = $this->payload->toNative();
        }

        return $data;
    }
}
