<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Dictionary;

abstract class AbstractIntDictionary extends AbstractDictionary implements DictionaryIntInterface
{
    public function getType(string $type): int
    {
        return (int) parent::getType($type);
    }

    public function getTypeWithId(int $id): string
    {
        return array_search($id, $this->getTypes(), true);
    }
}
