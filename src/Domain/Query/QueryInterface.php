<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Query;

use DddModule\Base\Domain\ValueObject\ProcessUuid;

interface QueryInterface
{
    /**
     * Get Process Uuid
     */
    public function getProcessUuid(): ProcessUuid;
}
