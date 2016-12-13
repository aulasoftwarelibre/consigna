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

use AppBundle\Doctrine\Annotation\Filter;
use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FolderController
 * @package AppBundle\Controller
 *
 * @Filter({
 *     "consigna_enabled_entity",
 *     "consigna_expired_entity",
 *     "consigna_scan_clean_file",
 * })
 * @Route("/")
 */
class HomepageController extends Controller
{
    /**
     * Creates a form to delete an item.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createDeleteFormAction()
    {
        $deleteForm =  $this
            ->createFormBuilder()
            ->setMethod('DELETE')
            ->getForm()
        ;

        return $this->render('frontend/Form/delete.html.twig', [
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @Route(
     *     "/",
     *     name="homepage"
     * )
     */
    public function homepageAction(Request $request)
    {
        $orderBy = $request->get('orderBy');
        if (!preg_match('/^\[(?<order>[.\w]+),(?<sort>\w+)\]$/', $orderBy, $orderBy)) {
            $orderBy = ['order' => 'o.name', 'sort' => 'ASC'];
        }

        $criteria = [
            'search' => $request->get('q'),
        ];

        $items = $this
            ->get('consigna.object_repository.item')
            ->findAllActiveBy($criteria, $orderBy);

        $folders = array_filter($items, function($item) {
            return $item instanceof FolderInterface;
        });

        $files = array_filter($items, function($item) {
            return $item instanceof FileInterface;
        });

        return $this->render('frontend/Default/homepage.html.twig', [
            'folders' => $folders,
            'files' => $files,
        ]);
    }
}