<?php

declare(strict_types=1);

namespace DddModule\Base\Application\QueryHandler;

use DddModule\Base\Domain\Query\QueryInterface;

interface QueryHandlerInterface
{
    /**
     * Handle specific query
     */
    public function handle(QueryInterface $query);
}
