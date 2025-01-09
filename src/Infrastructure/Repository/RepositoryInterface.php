<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository;

use DddModule\Base\Domain\Entity\EntityInterface;
use DddModule\Base\Domain\ValueObject\Uuid;

interface RepositoryInterface
{
    /**
     * Retrieve DocumentEntity with applied events
     */
    public function get(Uuid $uuid): EntityInterface;

    /**
     * Save DocumentEntity last uncommitted events
     */
    public function store(EntityInterface $entity): void;
}
