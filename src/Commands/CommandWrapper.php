<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Rareloop\Lumberjack\Application;
use Rareloop\Hatchet\Commands\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class CommandWrapper extends Command
{
    protected $command;

    public function __construct(Application $app, SymfonyCommand $command, string $signature, string $description = null)
    {
        $this->signature = $signature;
        $this->command = $command;

        parent::__construct($app);

        $this->setDescription($description ?: $command->getDescription());
        $this->setDefinition($command->getDefinition());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->command->execute($input, $output);
    }
}
