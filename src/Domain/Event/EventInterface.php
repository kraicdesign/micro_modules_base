<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Event;

use Broadway\Serializer\Serializable;
use DddModule\Base\Domain\ValueObject\Payload;
use DddModule\Base\Domain\ValueObject\ProcessUuid;
use MicroModule\EventQueue\Domain\EventHandling\EventInterface as EnqueueEventInterface;

interface EventInterface extends Serializable, EnqueueEventInterface
{
    public const KEY_UUID = "uuid";

    public const KEY_PROCESS_UUID = "process_uuid";

    public const KEY_PAYLOAD = "payload";

    /**
     * Get Process uuid
     */
    public function getProcessUuid(): ProcessUuid;

    /**
     * Return entity payload.
     */
    public function getPayload(): ?Payload;

    /**
     * Set entity payload.
     */
    public function setPayload(?Payload $payload): void;
}
