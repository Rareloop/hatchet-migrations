<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Rareloop\Lumberjack\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class ProtectedCommandWrapper extends CommandWrapper
{
    public function __construct(Application $app, Command $command, string $signature, string $description = null)
    {
        parent::__construct($app, $command, $signature, $description);

        $this->addOption('force', 'f', InputOption::VALUE_NONE, 'Supress confirmation on production environments');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->isAProductionEnvironment() && !$input->getOption('force')) {
            $helper = $this->getHelper('question');
            $output->writeln('<comment>**********************************</comment>');
            $output->writeln('<comment>*   Application in Production!   *</comment>');
            $output->writeln('<comment>**********************************</comment>');
            $output->writeln('');
            $output->writeln('<info>Are you sure you want to run this command? (yes/no)</info> [<comment>no</comment>]');
            $question = new ConfirmationQuestion('> ', false);

            if (!$helper->ask($input, $output, $question)) {
                return;
            }
        }

        $this->command->execute($input, $output);
    }

    protected function isAProductionEnvironment()
    {
        return !$this->app->get('config')->get('app.debug');
    }
}
