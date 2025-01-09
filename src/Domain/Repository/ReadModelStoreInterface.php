<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Repository;

use DddModule\Base\Domain\ReadModel\ReadModelInterface;
use UnexpectedValueException;

interface ReadModelStoreInterface
{
    /**
     * Finds an object by its primary key / identifier.
     */
    public function findOne(string $uuid): array;

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array;

    /**
     * Finds a single object by a set of criteria.
     */
    public function findOneBy(array $criteria): array;

    /**
     * Insert new user into storage
     */
    public function insertOne(ReadModelInterface $readModel): void;

    /**
     * Update one user in store
     */
    public function updateOne(ReadModelInterface $readModel): void;

    /**
     * Append new snapshot payload into storage
     */
    public function deleteOne(ReadModelInterface $readModel): void;
}
