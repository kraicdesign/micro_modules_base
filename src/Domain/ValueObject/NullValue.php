<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\ValueObject;

use DddModule\ValueObject\NullValue\NullValue as BaseNullValue;

class NullValue extends BaseNullValue implements NullValueObjectInterface
{
}
