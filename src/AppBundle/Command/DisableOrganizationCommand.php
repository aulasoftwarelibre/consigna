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

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisableOrganizationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:organization:disable')
            ->addArgument('code');
    }

    public function getDescription()
    {
        $translator = $this->getContainer()->get('translator');

        return $translator->trans('action.organization_disable', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translator = $this->getContainer()->get('translator');
        $repository = $this->getContainer()->get('consigna.repository.organization');

        $organization = $repository->findOneBy([
            'code' => $input->getArgument('code'),
        ]);

        if (!$organization) {
            $output->writeln(
                $translator->trans('action.organization_missing', [], 'command')
            );

            return 1;
        }

        $this->getContainer()->get('consigna.manager.organization')->disableOrganization($organization);

        $output->writeln(
            $translator->trans('action.organization_disable_success', ['%name%' => $organization], 'command')
        );
    }
}
