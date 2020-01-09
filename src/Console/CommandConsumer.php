<?php

namespace App\Console;

use Domain\Async\AsyncAdapter;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommandConsumer
 */
final class CommandConsumer extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'commands-consumer';

    /**
     * @var CommandBus
     */
    private $bus;

    /**
     * @var AsyncAdapter
     */
    private $asyncAdapter;

    /**
     * CommandConsumer constructor.
     *
     * @param CommandBus $asyncWriteBus
     * @param AsyncAdapter $asyncAdapter
     */
    public function __construct(
        CommandBus $asyncWriteBus,
        AsyncAdapter $asyncAdapter
    )
    {
        parent::__construct();

        $this->bus = $asyncWriteBus;
        $this->asyncAdapter = $asyncAdapter;
    }


    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this
            ->asyncAdapter
            ->createQueue();

        $this
            ->asyncAdapter
            ->consumeCommand(function($command) use ($output) {
                $this
                    ->bus
                    ->handle($command);

                $output->writeln(sprintf('Command %s consumed', str_replace(
                    'Domain\Command\\',
                    '',
                    get_class($command)
                )));
            });
    }
}