<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Factory;

use MicroModule\Base\Domain\Command\CommandInterface;
use MicroModule\Base\Domain\Dto\DtoInterface;

interface CommandFactoryInterface
{
    /**
     * Check if command is allowed for current factory
     */
    public function isCommandAllowed(string $commandType): bool;

    /**
     * Make command by command constant.
     */
    public function makeCommandInstanceByTypeFromDto(string $commandType, DtoInterface $dto): CommandInterface;

    /**
     * Make CommandBus command instance by constant type.
     *
     * @param mixed ...$args
     */
    public function makeCommandInstanceByType(...$args): CommandInterface;
}
