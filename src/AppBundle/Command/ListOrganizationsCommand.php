<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 3/05/15
 * Time: 20:23.
 */
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $organizations = $this->getContainer()->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:Organization')->findAll();
        foreach ($organizations as $organization) {
            $output->writeln($organization->getCode().' | '.$organization->getName().' | '.$organization->getIsEnabled());
        }
    }
}
