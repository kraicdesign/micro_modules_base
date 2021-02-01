<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Service;

/**
 * Contract for objects normalize by the NormalizebleDto.
 */
interface NormalizableServiceInterface
{
    /**
     * Denormalize array to object.
     *
     * @param mixed[] $data
     */
    public function denormalize(array $data): object;

    /**
     * Nermolize object to array.
     *
     * @return mixed[]
     */
    public function normalize(object $object): array;
}
