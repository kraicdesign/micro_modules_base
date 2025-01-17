<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\Utils;

use Temporal\Client\WorkflowClientInterface;

class Command extends \Symfony\Component\Console\Command\Command
{
    // Command name.
    protected const NAME = "";

    //  Short command description.
    protected const DESCRIPTION = "";

    // Command options specified in Symphony format. For more complex definitions redefine
    // getOptions() method.
    protected const OPTIONS = [];

    // Command arguments specified in Symphony format. For more complex definitions redefine
    // getArguments() method.
    protected const ARGUMENTS = [];

    protected WorkflowClientInterface $workflowClient;

    public function __construct(WorkflowClientInterface $workflowClient)
    {
        parent::__construct();
        $this->workflowClient = $workflowClient;
    }

    /**
     * @return static
     */
    public static function create(string $class, WorkflowClientInterface $workflowClient): self
    {
        return new $class($workflowClient);
    }

    /**
     * Configures the command.
     */
    protected function configure(): void
    {
        $this->setName(static::NAME);
        $this->setDescription(static::DESCRIPTION);

        foreach ($this->defineOptions() as $option) {
            call_user_func_array([$this, "addOption"], $option);
        }

        foreach ($this->defineArguments() as $argument) {
            call_user_func_array([$this, "addArgument"], $argument);
        }
    }

    /**
     * Define command options.
     */
    protected function defineOptions(): array
    {
        return static::OPTIONS;
    }

    /**
     * Define command arguments.
     */
    protected function defineArguments(): array
    {
        return static::ARGUMENTS;
    }
}
