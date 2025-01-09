<?php

declare(strict_types=1);

namespace DddModule\Base\Application\Service;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

class MappingCollector implements MappingCollectorInterface
{
    /**
     * @var array<JsonRpcMethodInterface>
     */
    protected array $mappingList = [];

    public function addJsonRpcMethod(string $methodName, JsonRpcMethodInterface $method): void
    {
        $this->mappingList[$methodName] = $method;
    }

    public function getMappingList(): array
    {
        return $this->mappingList;
    }
}
