<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Dictionary;

interface DictionaryInterface
{
    /**
     * Check type existence with type alias
     */
    public function hasType(string $type): bool;

    /**
     * Get type id with type alias
     *
     * @return string|int
     */
    public function getType(string $type);
}
