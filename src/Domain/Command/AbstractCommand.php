<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Command;

use MicroModule\Base\Domain\ValueObject\ProcessUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractCommand implements CommandInterface
{
    public function __construct(
        protected ?ProcessUuid $processUuid,
        protected ?UuidInterface $uuid
    ) {
    }

    public function getProcessUuid(): ?ProcessUuid
    {
        return $this->processUuid;
    }

    /**
     * Return Uuid value object.
     */
    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }
}
