<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository;

use DddModule\Base\Utils\LoggerTrait;
use DddModule\Base\Domain\Repository\QueryLiteRepositoryInterface;
use DddModule\Base\Domain\Repository\ReadModelStoreInterface;
use DddModule\Base\Domain\ValueObject\FindCriteria;
use DddModule\Base\Domain\ValueObject\Uuid;
use DddModule\Base\Infrastructure\Repository\Exception\NotFoundException;

class QueryLiteRepository implements QueryLiteRepositoryInterface
{
    use LoggerTrait;

    public function __construct(
        protected ReadModelStoreInterface $readModelStore
    ) {
    }

    public function findByUuid(Uuid $uuid): ?array
    {
        try {
            return $this->readModelStore->findOne($uuid->toNative());
        } catch (NotFoundException) {
            return null;
        }
    }

    public function findByCriteria(FindCriteria $findCriteria): ?array
    {
        try {
            return $this->readModelStore->findBy($findCriteria->toNative());
        } catch (NotFoundException) {
            return null;
        }
    }
}
