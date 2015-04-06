<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('command:delete')
            ->setDescription('Delete lapsed files ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = new \DateTime('-7 days');
        $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:File')->deleteLapsedFiles($date);
        $output->writeln('file has been removed');
    }
}