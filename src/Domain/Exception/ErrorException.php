<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use Exception;

/**
 * Class ErrorException.
 *
 * @category Exception
 */
class ErrorException extends Exception implements ExceptionLevelsInterface, ParentExceptionInterface
{
    use ParentExceptionTrait, ExceptionLevelsTrait;
}
