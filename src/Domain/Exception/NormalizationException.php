<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Exception;

use RuntimeException;

/**
 * Exception thrown if an error occurs during (de)normalization.
 */
class NormalizationException extends RuntimeException
{
}
