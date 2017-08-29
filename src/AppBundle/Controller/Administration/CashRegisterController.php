<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\CashRegister as FormCashRegister;
use AppBundle\Form\Type\Administration\CashRegisterType;
use IssueInvoices\Domain\Model\Administration\CashRegister;

class CashRegisterController extends Controller
{
    /**
     * @Route("/administration/cashregisters",name="AppBundle_Administration_cashRegisters")
     */
    public function cashRegistersAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        $cashRegisters = $userAdministration->getCashRegisters();

        return $this->render('AppBundle:Administration:cashRegisters.html.twig', [
            'cashRegisters' => $cashRegisters
        ]);
    }

    /**
     * @Route("/administration/cashRegister/add", name="AppBundle_Administration_addCashRegister")
     */
    public function addCashRegisterAction(Request $request)
    {
        $formCashRegister = new FormCashRegister();
        // Dohvatiti administraciju prijavljenog korisnika
        $offices = $this->getUser()->getAdministration()->getOffices();

        $form = $this->createForm(
            CashRegisterType::class, 
            $formCashRegister,
            ['offices' => $offices]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formCashRegister = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $cashRegister = new CashRegister();
            $cashRegister->setLabel($formCashRegister->label);
            
            // Pronaci office za $formCashRegister->office
            $office = $userAdministration->getOfficeById($office->getId());
            $userAdministration->addCashRegisterForOffice($cashRegister, $office);

            $entityManager->persist($userAdministration);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_cashRegisters');
        }

        return $this->render('AppBundle:Administration:addCashRegister.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/cashRegister/edit/{cashRegisterId}", name="AppBundle_Administration_editCashRegister")
     */
    public function editCashRegisterAction(Request $request, int $cashRegisterId)
    {
        $formCashRegister = new FormCashRegister();

        // Nađi poslovni prostor za poslani slug u ruti
        $office = $this->get('app.office_repository')->find($officeId);

        $formOffice->label = $office->getLabel();
        $formOffice->address = $office->getAddress();

        $form = $this->createForm(OfficeType::class, $formOffice);
        $form->handleRequest($request);

        // Dohvatiti prijavljenog korisnika i njegovu administraciju
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $administration = $user->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formOffice = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $office->setLabel($formOffice->label);
            $office->setAddress($formOffice->address);

            $office->setAdministration($administration);
            $entityManager->persist($office);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_offices'); 
        }

        return $this->render('AppBundle:Administration:addOffice.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/office/delete/{officeId}", name="AppBundle_Administration_deleteOffice")
     */
    public function deleteOfficeAction(int $officeId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $office = $this->get('app.office_repository')->findOneById($officeId);

        $entityManager->remove($office);
        $entityManager->flush();

        return $this->redirectToRoute('AppBundle_Administration_offices');
    }
}
