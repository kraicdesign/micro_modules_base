<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Event;

use Assert\Assertion;
use MicroModule\Base\Domain\ValueObject\Payload;
use MicroModule\Base\Domain\ValueObject\ProcessUuid;
use MicroModule\Base\Domain\ValueObject\Uuid;
use RuntimeException;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractEvent implements EventInterface
{
    protected ?Payload $payload = null;

    public function __construct(
        protected ProcessUuid $processUuid,
        protected Uuid $uuid,
        ?Payload $payload = null
    ) {
        $this->payload = $payload;
    }

    public static function deserialize(array $data): static
    {
        if (static::class === __CLASS__) {
            throw new RuntimeException("You can`t instantiate abstract class");
        }
        Assertion::keyExists($data, self::KEY_PROCESS_UUID);
        Assertion::keyExists($data, self::KEY_UUID);

        $event = new static(
            ProcessUuid::fromNative($data[self::KEY_PROCESS_UUID]),
            Uuid::fromNative($data[self::KEY_UUID])
        );

        if (isset($data[self::KEY_PAYLOAD])) {
            $event->setPayload(Payload::fromNative($data[self::KEY_PAYLOAD]));
        }

        return $event;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProcessUuid(): ProcessUuid
    {
        return $this->processUuid;
    }

    /**
     * @return array<string, mixed>
     */
    public function serialize(): array
    {
        $data = [
            self::KEY_PROCESS_UUID => $this->processUuid->toNative(),
            self::KEY_UUID => $this->uuid->toNative(),
        ];

        if ($this->payload !== null) {
            $data[self::KEY_PAYLOAD] = $this->payload->toNative();
        }

        return $data;
    }

    /**
     * Return entity payload.
     */
    public function getPayload(): ?Payload
    {
        return $this->payload;
    }

    /**
     * Set entity payload.
     */
    public function setPayload(?Payload $payload): void
    {
        $this->payload = $payload;
    }
}
