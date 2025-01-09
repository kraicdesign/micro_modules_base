<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use Throwable;

/**
 * Interface ParentExceptionInterface.
 *
 * @category Exception
 */
interface ParentExceptionInterface
{
    public const CONTEXT_SELIALIZE_NONE = "none";
    public const CONTEXT_SELIALIZE_BASIC = "serialize";
    public const CONTEXT_SELIALIZE_JSON = "json";
    public const CONTEXT_SELIALIZE_PRINTR = "printr";

    /**
     * Return parent exception.
     */
    public function getParentException(): Throwable;

    /**
     * Return context exception array from parent exception object.
     *
     * @param mixed[] $context
     *
     * @return mixed[]
     */
    public function getParentExceptionContext(array $context = [], string $contextSerializeType = self::CONTEXT_SELIALIZE_NONE): array;
}
