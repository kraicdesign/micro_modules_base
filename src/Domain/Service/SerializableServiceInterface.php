<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Service;

/**
 * Contract for objects serializable by the SerializableDto.
 */
interface SerializableServiceInterface
{
    /**
     * Deserialize data to object.
     *
     * @param mixed $data
     *
     * @return object The object instance
     */
    public function deserialize($data): object;

    /**
     * Serialize object to array.
     *
     * @return mixed
     */
    public function serialize(object $object);
}
