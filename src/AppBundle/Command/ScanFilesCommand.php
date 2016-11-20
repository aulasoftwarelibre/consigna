<?php

namespace AppBundle\Command;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScanFilesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:cron:scanfiles')
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
        return $this->getContainer()->get('translator')->trans('action.scan_files', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $this->getContainer()->get('consigna.repository.file')->findAll();

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        /** @var File $file */
        foreach ($files as $file) {
            $result = $this->getContainer()->get('consigna.service.scan_file')->scan($file->getPath());
            if ($result['status'] !== 'OK') {
                $output->writeln($this->getContainer()->get('translator')->trans('action.scan_virus_detected', ['%file%' => $file->getPath()], 'command'));
                $file->setScanStatus(File::SCAN_STATUS_INFECTED);
            } else {
                $file->setScanStatus(File::SCAN_STATUS_OK);
            }
            $em->persist($file);
        }
        $em->persist($file);
        $em->flush();

        $output->writeln($this->getContainer()->get('translator')->trans('action.scan_files_success', [], 'command'));
    }
}
