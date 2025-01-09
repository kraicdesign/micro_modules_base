<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Dictionary;

interface DictionaryIntInterface extends DictionaryInterface
{
    public function getType(string $type): int;

    /**
     * Get type alias with type id
     */
    public function getTypeWithId(int $id): string;
}
