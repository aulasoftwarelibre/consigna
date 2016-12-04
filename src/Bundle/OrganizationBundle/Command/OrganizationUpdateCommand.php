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
use Bundle\OrganizationBundle\Entity\Interfaces\OrganizationInterface;
use Bundle\OrganizationBundle\Entity\Organization;
use Goutte\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class OrganizationUpdateCommand extends AbstractOrganizationCommand
{
    const URL = 'https://www.rediris.es/sir/idps.php';

    protected function configure()
    {
        $this
            ->setName('consigna:organization:update')
        ;
    }

    public function getDescription()
    {
        return $this->translator->trans('action.database_init', [], 'command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->translator->trans('reading_data', [], 'command'));
        $organizations = $this->scrapping();

        /** @var Organization $organization */
        foreach ($organizations as $organization) {
            if (isset($organization['code'])) {
                $found = $this->organizationRepository->findOneBy(['code' => $organization['code']]);
                if ($found instanceof OrganizationInterface) {
                    $this->organizationManager->updateOrganization($found, $organization['name']);
                } else {
                    $this->organizationManager->createOrganization($organization['name'], $organization['code']);
                }
            }
        }

        $output->writeln(
            $this->translator->trans('action.database_success', [], 'command')
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
                return null;
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
