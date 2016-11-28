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
        ;
    }

    public function getDescription()
    {
        return $this->getContainer()->get('translator')->trans('action.database_init', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translator = $this->getContainer()->get('translator');

        $organizationDirector = $this->getContainer()->get('consigna.director.organization');
        $organizationManager = $this->getContainer()->get('consigna.manager.organization');

        $output->writeln($translator->trans('reading_data', [], 'command'));
        $organizations = $this->scrapping();

        /** @var Organization $organization */
        foreach ($organizations as $organization) {
            if (isset($organization['code'])) {
                if ($found = $organizationDirector->findOneBy(['code' => $organization['code']])) {
                    $organizationManager->updateOrganization($found, $organization['name']);
                } else {
                    $organizationManager->createOrganization($organization['name'], $organization['code']);
                }
            }
        }

        $output->writeln(
            $translator->trans('action.database_success', [], 'command')
        );
    }

    private function scrapping()
    {
        $client = new Client();
        $crawler = $client->request('GET', self::URL);

        $organizations = $crawler->filter('.codigo_scroll')->each(function (Crawler $node) {
            $university = $node->filter('div > a')->getNode(1)->textContent;

            $data = $node->filter('table > tbody > tr')->each(function (Crawler $node) {
                $key = $node->filter('td')->getNode(0)->textContent;
                $value = $node->filter('td')->getNode(1)->textContent;

                return [$key => $value];
            });

            $metadata = [];
            array_walk($data, function ($element) use (&$metadata) {
                $metadata = array_merge($metadata, $element);
            });

            if (empty($metadata['sHO'])) {
                return;
            }

            $organization = [
                'name' => $university,
                'code' => $metadata['sHO'],
            ];

            return $organization;
        });

        return $organizations;
    }
}
