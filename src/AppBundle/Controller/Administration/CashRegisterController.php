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
     * @Route("/administration/cashRegister", name="AppBundle_Administration_cashRegister")
     */
    public function cashRegisterAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        // Dohvatiti sve kupce iz repozitorija i prikazati
        $offices = $this->get('app.cash_register_repository')
                    ->findAllForUserAdministration();

        return $this->render('AppBundle:Administration:offices.html.twig', [
            'offices' => $offices
        ]);
    }

    /**
     * @Route("/administration/office/add", name="AppBundle_Administration_addOffice")
     */
    public function addOfficeAction(Request $request)
    {
        $formOffice = new FormOffice();
        $form = $this->createForm(OfficeType::class, $formOffice);

        $form->handleRequest($request);

        // Dohvatiti prijavljenog korisnika i njegovu administraciju
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $administration = $user->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formOffice = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $office = new Office();
            $office->setLabel($formOffice->label);
            $office->setAddress($formOffice->address);
            $office->setAdministration($administration);

            $entityManager->persist($office);
            $entityManager->flush();

            return $this->redirectToRoute('AppBundle_Administration_offices');
        }

        return $this->render('AppBundle:Administration:addOffice.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/administration/office/edit/{officeId}", name="AppBundle_Administration_editOffice")
     */
    public function editOfficeAction(Request $request, int $officeId)
    {
        $formOffice = new FormOffice();

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
