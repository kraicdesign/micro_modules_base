<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use DddModule\Base\Domain\Exception\CriticalException;

class MessageWasNotSentToQueueException extends CriticalException
{
}
