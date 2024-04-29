<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Repository;

use MicroModule\Base\Domain\ValueObject\FindCriteria;
use MicroModule\Base\Domain\ValueObject\Uuid;

interface QueryLiteRepositoryInterface
{
    /**
     * Find and return User by uuid
     */
    public function findByUuid(Uuid $uuid): ?array;

    /**
     * Find and return array of Users by FindCriteria
     */
    public function findByCriteria(FindCriteria $findCriteria): ?array;
}
