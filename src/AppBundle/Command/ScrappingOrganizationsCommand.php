<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 02/05/15
 * Time: 05:34
 */

namespace AppBundle\Command;


use AppBundle\Entity\Organization;
use Goutte\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class ScrappingOrganizationsCommand extends ContainerAwareCommand
{
    const URL = 'https://www.rediris.es/sir/idps.php';

    protected function configure()
    {
        $this
            ->setName('consigna:database:initialize')
            ->setDescription('Download data from IDPs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();


        $output->writeln("Recogiendo datos");
        $crawler = $client->request('GET', self::URL);

        $organizations = $crawler->filter('.codigo_scroll')->each(function (Crawler $node) use ($output) {
            $university = $node->filter('div > a')->getNode(1)->textContent;
            $output->writeln( $university );

            $data = $node->filter('table > tbody > tr')->each(function (Crawler $node) {
                $key = $node->filter('td')->getNode(0)->textContent;
                $value = $node->filter('td')->getNode(1)->textContent;
                return [$key => $value];
            });

            $metadata = [];
            array_walk($data, function($element) use (&$metadata) {
                $metadata = array_merge($metadata, $element);
            });

            if (empty($metadata['sHO'])) {
                return null;
            }

            $organization = new Organization();
            $organization->setName($university);
            $organization->setCode($metadata['sHO']);
            $organization->setIsEnabled(true);

            return $organization;
        });

        /** @var Organization $organization */
        foreach ($organizations as $organization) {
            if ($organization instanceof Organization
                && ! $this->getManager()->getRepository('AppBundle:Organization')->findOneBy(['code' => $organization->getCode()])
            ) {
                $this->getManager()->persist($organization);
            }
        }

        $this->getManager()->flush();
    }

    private function getManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }

}