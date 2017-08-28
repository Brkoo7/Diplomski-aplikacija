<?php
namespace AppBundle\Controller\Administration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Administration\Office as FormOffice;
use AppBundle\Form\Type\Administration\OfficeType;
use IssueInvoices\Domain\Model\Administration\Office;

class OfficeController extends Controller
{
    /**
     * @Route("/administration/offices", name="AppBundle_Administration_offices")
     */
    public function officesAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        $userAdministrationId = $userAdministration->getId();
        // Dohvatiti sve kupce iz repozitorija i prikazati
        $offices = $this->get('app.office_repository')->findAllForUserAdministration($userAdministrationId);

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

        // Dohvatiti administraciju prijavljenog korisnika
        $userAdministration = $this->getUser()->getAdministration();

        if ($form->isSubmitted() && $form->isValid()) {
            $formOffice = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $office = new Office();
            $office->setLabel($formOffice->label);
            $office->setAddress($formOffice->address);

            $userAdministration->addOffice($office);
            $entityManager->persist($userAdministration);
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

        if ($form->isSubmitted() && $form->isValid()) {
            $formOffice = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $office->setLabel($formOffice->label);
            $office->setAddress($formOffice->address);

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
