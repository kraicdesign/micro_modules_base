<?php

declare(strict_types=1);

namespace DddModule\Base\Application\Factory;

use DddModule\Base\Domain\Dto\DtoInterface;

interface DtoFactoryInterface
{
    /**
     * Make command by command constant.
     */
    public function makeDtoByType(...$args): DtoInterface;
}
