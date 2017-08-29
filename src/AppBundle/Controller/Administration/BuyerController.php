<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\Buyer as FormBuyer;
use AppBundle\Form\Type\Administration\BuyerType;
use IssueInvoices\Domain\Model\Administration\Buyer;

class BuyerController extends Controller
{
    /**
     * @Route("/administration/buyers", name="AppBundle_Administration_buyers")
     */
    public function buyersAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();

        // Dohvatiti sve kupce iz repozitorija i prikazati
        $buyers = $userAdministration->getBuyers();

        return $this->render('AppBundle:Administration:buyers.html.twig', [
            'buyers' => $buyers
        ]);
    }

    /**
     * @Route("/administration/buyer/add", name="AppBundle_Administration_addBuyer")
     */
    public function addBuyerAction(Request $request)
    {
        $formBuyer = new FormBuyer();
        $form = $this->createForm(BuyerType::class, $formBuyer);

        $form->handleRequest($request);

        // Dohvatiti administraciju prijavljenog korisnika
        $userAdministration = $this->getUser()->getAdministration();
        if ($form->isSubmitted() && $form->isValid()) {
            $formBuyer = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $buyer = new Buyer();
            $buyer->setName($formBuyer->name);
            $buyer->setOib($formBuyer->oib);
            $buyer->setPDVId($formBuyer->pdvID);
            $buyer->setAddress($formBuyer->address);

            $userAdministration->addBuyer($buyer);

            $entityManager->persist($userAdministration);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_buyers');
        }

        return $this->render('AppBundle:Administration:addBuyer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/buyer/edit/{buyerId}", name="AppBundle_Administration_editBuyer")
     */
    public function editBuyerAction(Request $request, int $buyerId)
    {
        $formBuyer = new FormBuyer();

        // Nađi kupca za poslani slug u ruti
        $userAdministration = $this->getUser()->getAdministration();
        $buyer = $userAdministration->getBuyerById($buyerId);

        $formBuyer->name = $buyer->getName();
        $formBuyer->oib = $buyer->getOib();
        $formBuyer->pdvID = $buyer->getPdvID();
        $formBuyer->address = $buyer->getAddress();

        $form = $this->createForm(BuyerType::class, $formBuyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formBuyer = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $buyer->setName($formBuyer->name);
            $buyer->setOib($formBuyer->oib);
            $buyer->setPDVId($formBuyer->pdvID);
            $buyer->setAddress($formBuyer->address);

            $entityManager->flush();
            return $this->redirectToRoute('AppBundle_Administration_buyers'); 
        }

        return $this->render('AppBundle:Administration:addBuyer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/buyer/delete/{buyerId}", name="AppBundle_Administration_deleteBuyer")
     */
    public function deleteBuyerAction(int $buyerId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userAdministration = $this->getUser()->getAdministration();
        $userAdministration->removeBuyerById($buyerId);

        $entityManager->flush();

        return $this->redirectToRoute('AppBundle_Administration_buyers');
    }
}
