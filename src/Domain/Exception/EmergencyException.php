<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use Exception;

/**
 * Class EmergencyException.
 *
 * @category Exception
 */
class EmergencyException extends Exception implements ExceptionLevelsInterface, ParentExceptionInterface
{
    protected string $level = self::EXCEPTION_LEVEL_EMERGENCY;

    use ParentExceptionTrait, ExceptionLevelsTrait;
}
