<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\ReadModel;

use JsonSerializable;

interface ReadModelInterface extends JsonSerializable
{
    public const KEY_UUID = "uuid";

    /**
     * Return entity primary key value
     */
    public function getPrimaryKeyValue();

    /**
     * Convert entity object to array
     *
     * @return array<string, mixed>
     */
    public function normalize(): array;
}
