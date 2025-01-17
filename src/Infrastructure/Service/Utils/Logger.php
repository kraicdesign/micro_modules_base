<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\Utils;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

/**
 * Sample logger for writing into stderr.
 */
class Logger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, $message, array $context = []): void
    {
        file_put_contents("php://stderr", sprintf("[%s] %s", $level, $message));
    }
}
