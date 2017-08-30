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
        $cashRegisters = $userAdministration->getAllCashRegisters();
        
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
        $userAdministration = $this->getUser()->getAdministration();
        $offices = $userAdministration->getOffices();

        $form = $this->createForm(
            CashRegisterType::class, 
            $formCashRegister,
            ['offices' => $offices]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formCashRegister = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $cashRegister = new CashRegister(
                $formCashRegister->label
            );
            $office = $formCashRegister->office;
            $cashRegister->setOffice($office);

            $entityManager->persist($cashRegister);
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

        // Nađi naplatni uređaj za poslani slug
        $cashRegister = $this->get('app.cashRegister_repository')->find($cashRegisterId);

        $formCashRegister->label = $cashRegister->getLabel();

        $form = $this->createForm(
            CashRegisterType::class,
            $formCashRegister,
            ['offices_choice_disabled' => true]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formCashRegister = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $cashRegister->setLabel($formCashRegister->label);

            $entityManager->persist($cashRegister);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_cashRegisters'); 
        }

        return $this->render('AppBundle:Administration:addCashRegister.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/administration/cashRegister/delete/{cashRegisterId}", name="AppBundle_Administration_deleteCashRegister")
     */
    public function deleteCashRegisterAction(int $cashRegisterId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cashRegister = $this->get('app.cashRegister_repository')->find($cashRegisterId);

        $entityManager->remove($cashRegister);
        $entityManager->flush();

        return $this->redirectToRoute('AppBundle_Administration_cashRegisters');
    }
}
