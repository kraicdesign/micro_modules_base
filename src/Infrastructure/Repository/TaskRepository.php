<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository;

use DateTimeInterface;
use Enqueue\Client\ProducerInterface;
use MicroModule\Task\Application\Processor\JobCommandBusProcessor;

/**
 * @class TaskRepository
 */
class TaskRepository implements TaskRepositoryInterface
{
    protected const KEY_MESSAGE_TYPE = "type";

    protected const KEY_MESSAGE_ARGS = "args";

    public function __construct(
        protected ProducerInterface $taskProducer
    ) {
    }

    public function produce(string $type, array $args): void
    {
        array_walk_recursive($args, function (&$value) {
            if (! is_scalar($value) && $value !== null) {
                if ($value instanceof DateTimeInterface) {
                    $value = $value->format(DateTimeInterface::ATOM);
                }
            }
        });
        $this->taskProducer->sendCommand(
            JobCommandBusProcessor::getRoute(),
            [
                static::KEY_MESSAGE_TYPE => $type,
                static::KEY_MESSAGE_ARGS => $args,
            ]
        );
    }
}
