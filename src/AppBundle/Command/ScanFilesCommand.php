<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Command;

use AppBundle\Entity\File;
use AppBundle\Services\Clamav\ScanedFile;
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

    public function getDescription()
    {
        $translator = $this->getContainer()->get('translator');

        return $translator->trans('action.scan_files', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $this->getContainer()->get('consigna.repository.file')->findAll();
        $translator = $this->getContainer()->get('translator');
        $scanFileService = $this->getContainer()->get('consigna.service.scan_file');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        /** @var File $file */
        foreach ($files as $file) {
            $result = $scanFileService->scan($file);
            if ($result->getStatus() !== ScanedFile::OK) {
                $output->writeln(
                    $translator->trans('action.scan_virus_detected', ['%file%' => $file->getPath()], 'command')
                );
                $file->setScanStatus(File::SCAN_STATUS_INFECTED);
            } else {
                $file->setScanStatus(File::SCAN_STATUS_OK);
            }
            $em->persist($file);
        }
        $em->flush();

        $output->writeln(
            $translator->trans('action.scan_files_success', [], 'command')
        );
    }
}
