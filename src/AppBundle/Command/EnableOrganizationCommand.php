<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 3/05/15
 * Time: 20:03.
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EnableOrganizationCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('consigna:organization:enable')
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
        return $this->getContainer()->get('translator')->trans('action.organization_enable', [], 'command');
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

        $organization->setisEnabled(true);
        $manager->persist($organization);
        $manager->flush();

        $output->writeln($translator->trans('action.organization_enable_success', ['%name%' => $organization], 'command'));
    }
}
