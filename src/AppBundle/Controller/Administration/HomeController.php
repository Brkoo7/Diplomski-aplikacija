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
        $userAdministration = $this->getUser()->getAdministration();
        $status = [
        	'seller' => $userAdministration->isExistSeller(),
        	'office' => $userAdministration->isExistOffice(),
        	'cashRegister' => $userAdministration->isExistCashRegister(),
        	'operator' => $userAdministration->isExistOperator()
        ];

        return $this->render('AppBundle:Administration:home.html.twig', [
            'status' => $status
        ]);
    }
}
