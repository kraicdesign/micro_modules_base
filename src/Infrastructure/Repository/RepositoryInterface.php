<?php

declare(strict_types=1);

namespace MicroModule\Base\Infrastructure\Repository;

use MicroModule\Base\Domain\Entity\EntityInterface;
use MicroModule\Base\Domain\ValueObject\Uuid;

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
