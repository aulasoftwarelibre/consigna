<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:cron:cleanfiles')
            ->setDescription('Delete lapsed files ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $days = $this->getContainer()->getParameter('days_before_clean');
        $date = new \DateTime('-'.$days.'days');
        $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:File')->deleteLapsedFiles($date);
        $output->writeln('file has been removed');
    }
}
