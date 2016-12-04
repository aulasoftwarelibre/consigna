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

use AppBundle\Command\Abstracts\AbstractOrganizationCommand;
use AppBundle\Entity\Interfaces\OrganizationInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrganizationDisableCommand extends AbstractOrganizationCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:organization:disable')
            ->addArgument('code');
    }

    public function getDescription()
    {
        return $this->translator->trans('action.organization_disable', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $organization = $this->organizationRepository->findOneBy([
            'code' => $input->getArgument('code'),
        ]);

        if (!($organization instanceof OrganizationInterface)) {
            $output->writeln(
                $this->translator->trans('action.organization_missing', [], 'command')
            );

            return 1;
        }

        $this->organizationManager->disableOrganization($organization);

        $output->writeln(
            $this->translator->trans('action.organization_disable_success', ['%name%' => $organization], 'command')
        );
    }
}
