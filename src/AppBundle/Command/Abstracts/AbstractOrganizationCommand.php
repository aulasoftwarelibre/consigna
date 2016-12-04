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

namespace AppBundle\Command\Abstracts;

use AppBundle\Repository\OrganizationRepository;
use AppBundle\Services\OrganizationManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Translation\TranslatorInterface;

abstract class AbstractOrganizationCommand extends Command
{
    /**
     * @var OrganizationManager
     */
    protected $organizationManager;
    /**
     * @var OrganizationRepository
     */
    protected $organizationRepository;
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(
        OrganizationManager $organizationManager,
        OrganizationRepository $organizationRepository,
        TranslatorInterface $translator
    ) {
        parent::__construct();

        $this->organizationManager = $organizationManager;
        $this->organizationRepository = $organizationRepository;
        $this->translator = $translator;
    }
}
