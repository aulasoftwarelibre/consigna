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

    /**
     * Returns the description for the command.
     *
     * @return string The description for the command
     *
     * @api
     */
    public function getDescription()
    {
        return $this->getContainer()->get('translator')->trans('action.organization_disable', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translator = $this->getContainer()->get('translator');
        $manager = $this->getContainer()->get('doctrine.orm.entity_manager');

        $organization = $this->getContainer()->get('consigna.repository.organization')->findOneBy([
            'code' => $input->getArgument('code'),
        ]);

        if (!$organization) {
            $output->writeln($translator->trans('action.organization_missing', [], 'command'));

            return 1;
        }

        $organization->setisEnabled(false);
        $manager->persist($organization);
        $manager->flush();

        $output->writeln($translator->trans('action.organization_disable_success', ['%name%' => $organization], 'command'));
    }
}
