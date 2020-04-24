<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use Exception;

/**
 * Class AlertException.
 *
 * @category Exception
 */
class AlertException extends Exception
{
    use ParentExceptionTrait;
}
