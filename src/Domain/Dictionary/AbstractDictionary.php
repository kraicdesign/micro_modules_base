<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Dictionary;

use Exception;

abstract class AbstractDictionary implements DictionaryInterface
{
    public function getType(string $type)
    {
        if ($this->hasType($type) === false) {
            throw new Exception(sprintf("Type `%s` is missed", $type));
        }

        return $this->getTypes()[$type];
    }

    public function hasType(string $type): bool
    {
        return array_key_exists($type, $this->getTypes());
    }

    /**
     * @return array<string,mixed>
     */
    abstract protected function getTypes(): array;
}
