<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use Exception;

/**
 * Class CriticalException.
 *
 * @category Exception
 */
class CriticalException extends Exception
{
    use ParentExceptionTrait;
}
