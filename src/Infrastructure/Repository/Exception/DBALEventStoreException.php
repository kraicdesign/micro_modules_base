<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository\Exception;

use DddModule\Base\Domain\Exception\CriticalException;

class DBALEventStoreException extends CriticalException
{
}
