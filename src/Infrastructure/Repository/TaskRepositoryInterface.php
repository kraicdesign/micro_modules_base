<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository;

interface TaskRepositoryInterface
{
    /**
     * Retrieve DocumentEntity with applied events
     */
    public function produce(string $type, array $args): void;
}
