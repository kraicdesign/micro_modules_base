<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Factory;

use MicroModule\Base\Domain\Command\CommandInterface;

/**
 * Interface CommandFactoryInterface.
 *
 * @category Command
 */
interface CommandFactoryInterface
{
    /**
     * Make CommandBus command instance by constant type.
     *
     * @param mixed ...$args
     */
    public function makeCommandInstanceByType(...$args): CommandInterface;
}
