<?php

declare(strict_types=1);

namespace MicroModule\Base\Utils;

use MicroModule\Base\Domain\Exception\AlertException;
use MicroModule\Base\Domain\Exception\CriticalException;
use MicroModule\Base\Domain\Exception\EmergencyException;
use MicroModule\Base\Domain\Exception\ErrorException;
use MicroModule\Base\Domain\Exception\LoggerException;
use MicroModule\Base\Domain\Exception\ParentExceptionInterface;
use MicroModule\Base\Domain\Exception\ParentExceptionTrait;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Trait LoggerTrait.
 *
 * @category MicroModule\Base
 */
trait LoggerTrait
{
    use ParentExceptionTrait;

    /**
     * Default exception message template.
     *
     * @var string
     */
    protected $exceptionMessageTemplate = 'Uncaught PHP Exception %s: "%s" at %s line %s';

    /**
     * Logger service.
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ExceptionListener constructor.
     *
     * @param LoggerInterface $logger
     *
     * @return $this
     *
     * @required
     */
    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Log an regular message or warning.
     *
     * @param string  $message
     * @param int     $level
     * @param mixed[] $context
     *
     * @return $this
     */
    public function logMessage(string $message, int $level, array $context = []): self
    {
        if (!$this->logger instanceof LoggerInterface) {
            return $this;
        }

        switch ($level) {
            case LOG_DEBUG:
                $this->logger->debug($message, $context);

                break;

            case LOG_INFO:
                $this->logger->info($message, $context);

                break;

            case LOG_NOTICE:
                $this->logger->notice($message, $context);

                break;

            case LOG_WARNING:
                $this->logger->warning($message, $context);

                break;

            default:
                throw new LoggerException(sprintf("Try to log invalid message level type '%s'", $level));

                break;
        }

        return $this;
    }

    /**
     * Log an exception.
     *
     * @param Throwable $exception The \Throwable instance
     * @param int       $level
     * @param string    $message   The error message to log
     *
     * @return $this
     */
    public function logException(Throwable $exception, int $level, string $message): self
    {
        if (!$this->logger instanceof LoggerInterface) {
            return $this;
        }

        $context = ['exception' => $exception];
        $this->parentException = $exception;
        $context = $this->getParentExceptionContext($context, ParentExceptionInterface::CONTEXT_SELIALIZE_PRINTR);

        switch ($level) {
            case LOG_EMERG:
                $this->logger->emergency($message, $context);

                break;

            case LOG_ALERT:
                $this->logger->alert($message, $context);

                break;

            case LOG_CRIT:
                $this->logger->critical($message, $context);

                break;

            case LOG_ERR:
                $this->logger->error($message, $context);

                break;

            default:
                throw new LoggerException(sprintf("Try to log invalid error level type '%s'", $level));

                break;
        }

        return $this;
    }

    /**
     * Define exception level from exception type.
     *
     * @param Throwable $exception
     *
     * @return int
     */
    public function getExceptionLevel(Throwable $exception): int
    {
        switch (true) {
            case $exception instanceof EmergencyException:
                return LOG_EMERG;

            case $exception instanceof AlertException:
                return LOG_ALERT;

            case $exception instanceof CriticalException:
                return LOG_CRIT;

            case $exception instanceof ErrorException:
                return LOG_ERR;
        }

        return LOG_ERR;
    }

    /**
     * Generate exception message.
     *
     * @param Throwable $exception
     *
     * @return string
     */
    public function getExceptionMessage(Throwable $exception): string
    {
        return sprintf($this->exceptionMessageTemplate, get_class($exception), $exception->getMessage(), $exception->getFile(), $exception->getLine());
    }
}
