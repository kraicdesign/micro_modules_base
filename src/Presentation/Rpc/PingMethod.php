<?php

declare(strict_types=1);

namespace DddModule\Base\Presentation\Rpc;

use Yoanm\JsonRpcServer\Domain\JsonRpcMethodInterface;

/**
 * Health check class
 */
class PingMethod implements JsonRpcMethodInterface
{
    /**
     * @suppress PhanUnusedPublicMethodParameter
     */
    public function apply(?array $paramList = null)
    {
        return "pong";
    }
}
