<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/administration/home", name="AppBundle_Administration_home")
     */
    public function homeAction(Request $request)
    {
        $response = $this->render('AppBundle:Administration:home.html.twig');

        return $response;
    }
}
