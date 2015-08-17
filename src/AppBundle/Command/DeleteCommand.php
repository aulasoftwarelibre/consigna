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
        ;
    }

    /**
     * Returns the description for the command.
     *
     * @return string The description for the command
     *
     * @api
     */
    public function getDescription()
    {
        return $this->getContainer()->get('translator')->trans('action.clean_files', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('consigna.repository.folder')->deleteExpired();
        $this->getContainer()->get('consigna.repository.file')->deleteExpired();
        $output->writeln($this->getContainer()->get('translator')->trans('action.clean_files_success', [], 'command'));
    }
}
