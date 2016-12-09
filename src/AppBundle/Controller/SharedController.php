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


namespace AppBundle\Controller;


use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\ItemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SharedController extends Controller
{
    /**
     * Give access to an item with the shared code.
     *
     * @param ItemInterface $item
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Method("GET")
     * @ParamConverter(
     *     "item",
     *     class="AppBundle:Item",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/s/{sharedCode}",
     *     name="shared_access_item"
     * )
     */
    public function accessSharedAction(ItemInterface $item)
    {
        $user = $this->getUser();

        if ($item instanceof FolderInterface) {
            $this
                ->get('consigna.manager.folder')
                ->sharedFolderWithUser($item, $user);

            return $this->redirectToRoute('folder_show', [
                'slug' => $item->getSlug(),
            ]);
        } elseif ($item instanceof FileInterface) {
            $this
                ->get('consigna.manager.file')
                ->sharedFileWithUser($item, $user);

            return $this->redirectToRoute('file_show', [
                'slug' => $item->getSlug(),
            ]);
        }

        throw new \InvalidArgumentException('Item type not supported: '.get_class($item));
    }
}