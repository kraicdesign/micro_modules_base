<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Entity;

use Broadway\Domain\AggregateRoot;
use MicroModule\Base\Domain\ValueObject\ProcessUuid;
use MicroModule\Base\Domain\ValueObject\Uuid;
use MicroModule\Snapshotting\EventSourcing\AggregateAssemblerInterface;

interface EntityInterface extends AggregateRoot, AggregateAssemblerInterface
{
    public const KEY_PROCESS_UUID = "process_uuid";

    public const KEY_UUID = "uuid";

    /**
     * Get ProcessUuid value object
     */
    public function getProcessUuid(): ?ProcessUuid;

    /**
     * Get Entity primary key value
     */
    public function getPrimaryKeyValue();

    /**
     * Get Uuid value object
     */
    public function getUuid(): ?Uuid;
}
