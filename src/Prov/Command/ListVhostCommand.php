<?php

namespace Prov\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Process\Process;

class ListVhostCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('list:vhost')
            ->setDescription('Lists all VHOSTs.')
            ->addArgument('config', InputArgument::REQUIRED, 'The config file.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $config = Yaml::parse(file_get_contents($input->getArgument('config')));

        $vhosts = [];

        foreach ($config['servers'] as $server => $options) {
            $process = new Process(sprintf('ssh %s@%s \'cd %s; %s\'',
                $options['username'],
                $server,
                $config['settings']['path'],
                'ls'
            ));
            $process->run();

            $vhosts[$server] = explode('  ', $process->getOutput());
        }

        print_r($vhosts);
    }
}
