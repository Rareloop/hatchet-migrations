<?php

namespace Rareloop\Hatchet\Migrations\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class ProtectedCommandWrapper extends CommandWrapper
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->isAProductionEnvironment()) {
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
