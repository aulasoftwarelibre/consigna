<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 3/05/15
 * Time: 20:31
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisableOrganizationCommand extends ContainerAwareCommand{

    protected function configure()
    {
        $this
            ->setName('consigna:organization:disable')
            ->setDescription('Change organization status to disable')
            ->addArgument('Code');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $organization = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Organization')->findOneByCode($input->getArgument('Code'));
        if(null===$organization) {
            $output->writeln('This organization does not exist');
        } else {
            $organization->setisEnabled(false);
            $this->getContainer()->get('doctrine.orm.default_entity_manager')->persist($organization);
            $this->getContainer()->get('doctrine.orm.default_entity_manager')->flush();
            $output->writeln('Organization status has been updated to disable');
        }
    }
}