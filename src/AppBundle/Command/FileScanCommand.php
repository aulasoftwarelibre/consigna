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


use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Services\FileManager;
use AppBundle\Services\ObjectDirector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\TranslatorInterface;

class FileScanCommand extends Command
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    /**
     * @var ObjectDirector
     */
    private $fileDirector;
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @inheritDoc
     */
    public function __construct(
        ObjectDirector $fileDirector,
        FileManager $fileManager,
        TranslatorInterface $translator
    ) {
        parent::__construct();

        $this->fileDirector = $fileDirector;
        $this->fileManager = $fileManager;
        $this->translator = $translator;
    }


    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setName('consigna:file:scan');
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->translator->trans('action.file_scan', [], 'command');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var FileInterface[] $files */
        $files = $this->fileDirector->findAll();

        foreach ($files as $file) {
            $output->write(
                $this
                    ->translator
                    ->trans('action.file_scanning', ['%file%' => basename($file->getPath())], 'command')
            );

            $this
                ->fileManager
                ->scanFile($file);

            $output->writeln(
                $this
                    ->translator
                    ->trans('action.file_scanning_result_'.$file->getScanStatus(), [], 'command')
            );
        }

        $output->writeln(
            $this
                ->translator
                ->trans('action.scan_files_success', [], 'command')
        );
    }
}