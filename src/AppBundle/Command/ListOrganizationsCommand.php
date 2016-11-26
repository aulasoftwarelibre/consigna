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

use AppBundle\Entity\Organization;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListOrganizationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:organization:list')
            ->setDescription('List organizations');
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
        return $this->getContainer()->get('translator')->trans('action.organization_list', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translator = $this->getContainer()->get('translator');
        $organizations = $this->getContainer()->get('consigna.repository.organization')->findAll();

        $table = new Table($output);
        $table->setHeaders([
            $translator->trans('name', [], 'command'),
            $translator->trans('code', [], 'command'),
            $translator->trans('active', [], 'command'),
        ]);

        /** @var Organization $organization */
        foreach ($organizations as $organization) {
            $table->addRow([
                $organization->getName(),
                $organization->getCode(),
                $organization->getIsEnabled() ? '<info>YES</info>' : '<error>NO</error>',

            ]);
        }

        $table->render();
    }
}
