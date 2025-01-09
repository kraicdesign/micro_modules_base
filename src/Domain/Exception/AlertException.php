<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use Exception;

/**
 * Class AlertException.
 *
 * @category Exception
 */
class AlertException extends Exception implements ExceptionLevelsInterface, ParentExceptionInterface
{
    protected string $level = self::EXCEPTION_LEVEL_ALERT;

    use ParentExceptionTrait, ExceptionLevelsTrait;
}
