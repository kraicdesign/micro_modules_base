<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use Throwable;

/**
 * Interface ExceptionLevelsInterface.
 *
 * @category Exception
 */
interface ExceptionLevelsInterface
{
    public const EXCEPTION_LEVEL_EMERGENCY  = 'emergency';
    public const EXCEPTION_LEVEL_ALERT      = 'alert';
    public const EXCEPTION_LEVEL_CRITICAL   = 'critical';
    public const EXCEPTION_LEVEL_ERROR      = 'error';

    /**
     * Return exception level const.
     */
    public function getExceptionLevel(): string;
}
