<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Command;

use DddModule\Base\Domain\ValueObject\Payload;
use DddModule\Base\Domain\ValueObject\ProcessUuid;
use Ramsey\Uuid\UuidInterface;

interface CommandInterface
{
    /**
     * Return ProcessUuid value object.
     */
    public function getProcessUuid(): ?ProcessUuid;

    /**
     * Return Uuid value object.
     */
    public function getUuid(): ?UuidInterface;

    /**
     * Return Payload value object.
     */
    public function getPayload(): ?Payload;
}
