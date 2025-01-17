<?php

declare(strict_types=1);

namespace DddModule\Base\Application\Service;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodAwareInterface;
use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

interface MappingCollectorInterface extends JsonRpcMethodAwareInterface
{
    /**
     * Return list of JsonRpcMethodInterface.
     *
     * @return JsonRpcMethodInterface[]
     */
    public function getMappingList(): array;
}
