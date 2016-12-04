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

namespace Bundle\OrganizationBundle\Command;

use Bundle\OrganizationBundle\Command\Abstracts\AbstractOrganizationCommand;
use Bundle\OrganizationBundle\Entity\Organization;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrganizationListCommand extends AbstractOrganizationCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:organization:list')
        ;
    }

    public function getDescription()
    {
        return $this->translator->trans('action.organization_list', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders([
            $this->translator->trans('name', [], 'command'),
            $this->translator->trans('code', [], 'command'),
            $this->translator->trans('active', [], 'command'),
        ]);

        $organizations = $this->organizationRepository->findAll();
        /** @var Organization $organization */
        foreach ($organizations as $organization) {
            $table->addRow([
                $organization->getName(),
                $organization->getCode(),
                $organization->isEnabled() ? '<info>YES</info>' : '<error>NO</error>',

            ]);
        }

        $table->render();
    }
}
