<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use Exception;

/**
 * Class EmergencyException.
 *
 * @category Exception
 */
class EmergencyException extends Exception
{
    use ParentExceptionTrait;
}
