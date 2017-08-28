<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\Seller as FormSeller;
use AppBundle\Form\Type\Administration\SellerType;
use IssueInvoices\Domain\Model\Administration\Seller;
use IssueInvoices\Domain\Model\Administration\SellerFactory;

class SellerController extends Controller
{
    /**
     * @Route("/administration/seller", name="AppBundle_Administration_seller")
     */
    public function sellerAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        $userAdministrationId = $userAdministration->getId();
        // Dohvatiti sve kupce iz repozitorija i prikazati
        $seller = $this->get('app.seller_repository')->findSellerForUserAdministration($userAdministrationId);

        return $this->render('AppBundle:Administration:seller.html.twig', [
            'seller' => $seller
        ]);
    }

    /**
     * @Route("/administration/seller/add", name="AppBundle_Administration_addSeller")
     */
    public function addSellerAction(Request $request)
    {
        $formSeller = new FormSeller();
        $form = $this->createForm(SellerType::class, $formSeller);

        $form->handleRequest($request);

        // Dohvatiti administraciju prijavljenog korisnika
        $userAdministration = $this->getUser()->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formSeller = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            dump($formSeller);
            $seller = new SellerFactory($formSeller);

            // Spremiti
            $seller->setAdministration($administration);
            $entityManager->persist($seller);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_seller');
        }

        return $this->render('AppBundle:Administration:addBuyer.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/seller/edit/{sellerId}", name="AppBundle_Administration_editSeller")
     */
    public function editSellerAction(Request $request, int $sellerId)
    {
        $formBuyer = new FormBuyer();

        // Nađi kupca za poslani slug u ruti
        $buyer = $this->get('app.buyer_repository')->find($buyerId);

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
}
