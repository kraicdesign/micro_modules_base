<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Command;

use DddModule\Base\Domain\ValueObject\Payload;
use DddModule\Base\Domain\ValueObject\ProcessUuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractCommand implements CommandInterface
{
    public function __construct(
        protected ?ProcessUuid $processUuid,
        protected ?UuidInterface $uuid,
        protected ?Payload $payload
    ) {
    }

    public function getProcessUuid(): ?ProcessUuid
    {
        return $this->processUuid;
    }

    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    public function getPayload(): ?Payload
    {
        return $this->payload;
    }
}
