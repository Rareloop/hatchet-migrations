<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Rareloop\Lumberjack\Application;
use Rareloop\Hatchet\Commands\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;

class CommandWrapper extends Command
{
    protected $command;

    public function __construct(Application $app, SymfonyCommand $command, string $signature, string $description = null)
    {
        $this->signature = $signature;
        $this->command = $command;

        parent::__construct($app);

        $this->setDescription($description ?: $command->getDescription());
        $this->setDefinition($this->buildDefinitionFromCommand($command));
    }

    protected function buildDefinitionFromCommand(SymfonyCommand $command): InputDefinition
    {
        $commandDefinition = $command->getDefinition();
        $thisDefinition = new InputDefinition();
        $thisDefinition->setArguments($commandDefinition->getArguments());

        $options = $commandDefinition->getOptions();

        // Strip options that we do not want to expose to the Hatchet Command
        unset($options['environment']);
        unset($options['parser']);
        unset($options['configuration']);

        $thisDefinition->setOptions($options);

        return $thisDefinition;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // As we've removed some options we need to make sure that these are present in the $input that
        // we provide to the actual command. We rebuild the $input from the arguments passed in and also
        // force the environment to be set to suppress the Phinx warning

        $combinedDefinition = $this->command->getDefinition();
        $combinedDefinition->addOptions($this->getDefinition()->getOptions());

        $argv = explode(' ', $input->__toString());

        if ($combinedDefinition->hasOption('environment')) {
            array_push($argv, '--environment=wp');
        }

        $newInput = new ArgvInput($argv, $combinedDefinition);

        $this->command->execute($newInput, $output);
    }
}
