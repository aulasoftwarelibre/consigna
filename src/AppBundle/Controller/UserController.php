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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package AppBundle\Controller
 *
 * @Filter({
 *     "consigna_enabled_entity",
 *     "consigna_expired_entity",
 *     "consigna_scan_clean_file",
 * })
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("GET")
     * @Route(
     *     "/files",
     *     name="user_files"
     * )
     */
    public function showUserFiles(Request $request)
    {
        $orderBy = $request->get('orderBy');
        if (!preg_match('/^\[(?<order>[.\w]+),(?<sort>\w+)\]$/', $orderBy, $orderBy)) {
            $orderBy = ['order' => 'o.name', 'sort' => 'ASC'];
        }

        $criteria = [
            'owner' => $this->getUser(),
        ];

        $items = $this->get('consigna.object_repository.item')->findAllActiveBy($criteria, $orderBy);

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

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("GET")
     * @Route(
     *     "/files/shared",
     *     name="user_files_shared"
     * )
     */
    public function showUserSharedFiles(Request $request)
    {
        $orderBy = $request->get('orderBy');
        if (!preg_match('/^\[(?<order>[.\w]+),(?<sort>\w+)\]$/', $orderBy, $orderBy)) {
            $orderBy = ['order' => 'o.name', 'sort' => 'ASC'];
        }

        $criteria = [
            'shared' => $this->getUser(),
        ];

        $items = $this->get('consigna.object_repository.item')->findAllActiveBy($criteria, $orderBy);

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