<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Factory;

use DddModule\Base\Domain\Dto\DtoInterface;
use DddModule\Base\Domain\Query\QueryInterface as BaseQueryInterface;

interface QueryFactoryInterface
{
    /**
     * Check if query is allowed for current factory
     */
    public function isQueryAllowed(string $queryType): bool;

    /**
     * Make command by command constant.
     */
    public function makeQueryInstanceByTypeFromDto(string $queryType, DtoInterface $dto): BaseQueryInterface;
}
