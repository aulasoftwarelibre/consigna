<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 07/08/15
 * Time: 23:56
 */

namespace AppBundle\Controller\Backend;

use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 *
 * @package AppBundle\Controller\Backend
 */
class AdminController extends BaseAdminController
{
    /**
     * @Route("/", name="admin")
     */
    public function indexAction(Request $request)
    {
        // if the URL doesn't include the entity name, this is the index page
        if (null === $request->query->get('entity')) {
            // define this route in any of your own controllers
            return $this->redirectToRoute('admin_dashboard');
        }

        // don't forget to add this line to serve the regular backend pages
        return parent::indexAction($request);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('backend/default/dashboard.html.twig');
    }
}