<?php

declare(strict_types=1);

namespace MicroModule\Base\Infrastructure\Repository;

use MicroModule\Base\Utils\LoggerTrait;
use MicroModule\Base\Domain\Repository\QueryLiteRepositoryInterface;
use MicroModule\Base\Domain\Repository\ReadModelStoreInterface;
use MicroModule\Base\Domain\ValueObject\FindCriteria;
use MicroModule\Base\Domain\ValueObject\Uuid;
use MicroModule\Base\Infrastructure\Repository\Exception\NotFoundException;
use MicroModule\Base\Infrastructure\Service\DataMapper\DataMapperInterface;

class QueryMapperRepository implements QueryLiteRepositoryInterface
{
    use LoggerTrait;

    public function __construct(
        protected ReadModelStoreInterface $readModelStore,
        protected DataMapperInterface $dbalDataMapper
    ) {
    }

    public function findByUuid(Uuid $uuid): ?array
    {
        try {
            return $this->dbalDataMapper->mapFromStorage($this->readModelStore->findOne($uuid->toNative()));
        } catch (NotFoundException) {
            return null;
        }
    }

    public function findByCriteria(FindCriteria $findCriteria): ?array
    {
        try {
            return $this->dbalDataMapper->mapFromStorage($this->readModelStore->findBy($findCriteria->toNative()));
        } catch (NotFoundException) {
            return null;
        }
    }
}
