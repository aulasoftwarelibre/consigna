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
            ->setDescription('Change organization status to enable')
            ->addArgument('Code');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $organization = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Organization')->findOneByCode($input->getArgument('Code'));
        if (null === $organization) {
            $output->writeln('This organization does not exist');
        } else {
            $organization->setIsEnabled(true);
            $this->getContainer()->get('doctrine.orm.default_entity_manager')->persist($organization);
            $this->getContainer()->get('doctrine.orm.default_entity_manager')->flush();
            $output->writeln('Organization status has been updated to enable');
        }
    }
}
