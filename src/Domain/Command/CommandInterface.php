<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface CommandInterface.
 *
 * @category Command
 */
interface CommandInterface
{
    /**
     * Return Uuid.
     */
    public function getUuid(): UuidInterface;
}
