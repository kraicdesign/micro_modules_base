<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Command;

use MicroModule\Base\Domain\ValueObject\ProcessUuid;
use Ramsey\Uuid\UuidInterface;

interface CommandInterface
{
    /**
     * Get Process Uuid
     */
    public function getProcessUuid(): ?ProcessUuid;
    /**
     * Return Uuid.
     */
    public function getUuid(): ?UuidInterface;
}
