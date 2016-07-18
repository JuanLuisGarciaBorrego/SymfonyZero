<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;


class DeployCommand extends Command
{
    protected $output;

    protected function configure()
    {
        $this
            ->setName('zero:deploy')
            ->setDescription('Run common deploy commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $this->output = $output;
      $this->runCommand('doctrine:schema:update', array('--force' => true));

      $this->runCommand('assetic:dump', array('--env' => 'prod', '--no-debug' => true));

      $this->runCommand('cache:clear', array());
      $this->runCommand('cache:clear', array('--env' => 'prod'));
    }

    protected function runCommand($command, $arguments)
    {
      $this->output->writeln('Running command: '.$command);
      $applicationCommand = $this->getApplication()->find($command);
      $input = new ArrayInput($arguments);

      $applicationCommand->run($input, $this->output);
      $this->output->writeln('Finished command: '.$command);
      $this->output->writeln('');
    }
}
