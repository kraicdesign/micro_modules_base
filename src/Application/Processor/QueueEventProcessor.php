<?php

declare(strict_types=1);

namespace MicroModule\Base\Application\Processor;

use MicroModule\EventQueue\Application\EventHandling\QueueEventProcessor as BaseQueueEventProcessor;

class QueueEventProcessor extends BaseQueueEventProcessor
{
    public static function getTopic(): string
    {
        return "micro-platform.*.queueevent";
    }
}
