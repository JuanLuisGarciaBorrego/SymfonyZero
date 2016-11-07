<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class DeployCommand extends ContainerAwareCommand
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
        $cachePath = $this->getContainer()->get('kernel')->getRootdir().'/../var/cache/*';
        $logsPath = $this->getContainer()->get('kernel')->getRootdir().'/../var/logs/*';
        $this->output = $output;

        $this->runCommand('doctrine:schema:update --force');

        $this->runCommand('cache:clear');
        $this->runCommand('cache:clear --env=prod');
        $this->runProccess('sudo chmod -R 777 '. $cachePath);
        $this->runProccess('sudo chmod -R 777 '. $logsPath);
    }

    protected function runProccess($command)
    {
      $this->output->writeln('<comment>Running command: '.$command.'</comment>');
      $process = new Process($command);
      $process->run();

      // After the command finishes
      if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
      }

      $this->output->write($process->getOutput());
      $this->output->writeln('<info>Finished command: '.$command.'</info>');
      $this->output->writeln('');
    }

    protected function runCommand($command)
    {
      $this->runProccess('php bin/console ' . $command);
    }
}
