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

        $seller = $userAdministration->getSeller();
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

            $seller = (new SellerFactory())->fromData($formSeller);

            $userAdministration->setSeller($seller);
            $entityManager->persist($userAdministration);
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
        $formSeller = new FormSeller();

        $userAdministration = $this->getUser()->getAdministration();
        $seller = $userAdministration->getSeller();

        $formSeller->companyName = $seller->getCompanyName();
        $formSeller->personName = $seller->getPersonName();
        $formSeller->oib = $seller->getOib();
        $formSeller->pdvID = $seller->getPdvID();
        $formSeller->phoneNumber = $seller->getPhoneNumber();
        $formSeller->email = $seller->getEmail();
        $formSeller->street = $seller->getStreet();
        $formSeller->postalCode = $seller->getPostalCode();
        $formSeller->city = $seller->getCity();
        $formSeller->countryCode = $seller->getCountryCode();
        $formSeller->inVATSystem = $seller->getInVatSystem();

        $form = $this->createForm(SellerType::class, $formSeller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formSeller = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $seller = (new SellerFactory())->fromDataAndObject($formSeller, $seller);

            $entityManager->flush();
            return $this->redirectToRoute('AppBundle_Administration_seller'); 
        }

        return $this->render('AppBundle:Administration:addSeller.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
