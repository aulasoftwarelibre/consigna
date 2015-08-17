<?php

namespace AppBundle\Command;

use AppBundle\Entity\File;
use CL\Tissue\Adapter\ClamAv\ClamAvAdapter;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

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
        $adapter = new ClamAvAdapter($this->getClamavPath());

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        /** @var File $file */
        foreach ($files as $file) {
            $result = $adapter->scan([$file->getPath()]);
            if ($result->hasVirus()) {
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

    private function getClamavPath()
    {
        $default_paths = [
            '/usr/bin/clamdscan',
            '/usr/local/bin/clamdscan',
            '/opt/bin/clamdscan',
        ];

        array_unshift($default_paths, $this->getContainer()->getParameter('antivirus_path'));

        foreach ($default_paths as $path) {
            if ($path && file_exists($path)) {
                return $path;
            }
        }

        throw new FileNotFoundException($this->getContainer()->get('translator')->trans('action.scan_files_missing', [], 'command'));
    }
}
