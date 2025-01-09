<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Repository;

use DddModule\Base\Domain\ValueObject\FindCriteria;
use DddModule\Base\Domain\ValueObject\Uuid;

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
