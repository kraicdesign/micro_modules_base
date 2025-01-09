<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Exception;

use Throwable;

/**
 * Trait ParentExceptionTrait.
 *
 * @category Exception
 */
trait ParentExceptionTrait
{
    /**
     * @var Throwable
     */
    protected $parentException;

    /**
     * Return parent exception.
     */
    public function getParentException(): Throwable
    {
        return $this->parentException;
    }

    /**
     * Return context exception array from parent exception object.
     *
     * @param mixed[] $context
     *
     * @return mixed[]
     */
    public function getParentExceptionContext(array $context = [], string $contextSerializeType = ParentExceptionInterface::CONTEXT_SELIALIZE_NONE): array
    {
        $exception = $this->getParentException();

        if ($exception instanceof ParentExceptionInterface) {
            $parentException = $exception->getParentException();
            $context['parentException'] = get_class($parentException);
            $context['parentExceptionErrorMessage'] = sprintf('%s: "%s" at %s line %s', get_class($parentException), $parentException->getMessage(), $parentException->getFile(), $parentException->getLine());
            $context['parentExceptionContext'] = $this->serializeContext($exception->getParentExceptionContext(), $contextSerializeType);
        }

        return $context;
    }

    /**
     * Serialize if needed context array to string.
     *
     * @param mixed[] $context
     *
     * @return mixed
     */
    protected function serializeContext(array $context = [], string $contextSerializeType = ParentExceptionInterface::CONTEXT_SELIALIZE_NONE)
    {
        switch ($contextSerializeType) {
            case ParentExceptionInterface::CONTEXT_SELIALIZE_BASIC:
                $context = serialize($context);

                break;

            case ParentExceptionInterface::CONTEXT_SELIALIZE_JSON:
                $context = json_encode($context);

                break;

            case ParentExceptionInterface::CONTEXT_SELIALIZE_PRINTR:
                $context = print_r($context, true);

                break;

            case ParentExceptionInterface::CONTEXT_SELIALIZE_NONE:
            default:
                break;
        }

        return $context;
    }
}
