<?php

declare(strict_types=1);

namespace DddModule\Base\Application\CommandHandler;

use DddModule\Base\Domain\Command\CommandInterface;

interface CommandHandlerInterface
{
    /**
     * Handle specific command
     */
    public function handle(CommandInterface $command);
}
