<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScanFilesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:cron:scanfiles')
            ->setDescription('virus scan for all files');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $antivirus_path = $this->getContainer()->getParameter('antivirus_path');
        $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:File')->scanAllFiles($antivirus_path);
        $output->writeln('The scan has been completed');
    }
}
