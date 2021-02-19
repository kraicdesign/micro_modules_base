<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use Throwable;

/**
 * Trait ParentExceptionTrait.
 *
 * @category Exception
 */
trait ExceptionLevelsTrait
{
    /**
     * Exception level.
     */
    protected string $levels = ExceptionLevelsInterface::EXCEPTION_LEVEL_ERROR;

    /**
     * Return exception level const.
     */
    public function getExceptionLevel(): string
    {
        return $this->levels;
    }
}
