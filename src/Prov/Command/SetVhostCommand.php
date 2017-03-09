<?php

namespace Prov\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;

class SetVhostCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('set:vhost')
            ->setDescription('Sets a VHOST with the given file.')
            ->addArgument('config', InputArgument::REQUIRED, 'The config file.')
            ->addArgument('vhost', InputArgument::REQUIRED, 'The name of the vhost file.')
            ->addArgument('file', InputArgument::REQUIRED, 'The vhost config file.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
    }
}
