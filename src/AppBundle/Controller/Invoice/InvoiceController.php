<?php
namespace AppBundle\Controller\Invoice;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Invoice\Invoice as FormInvoice;
use AppBundle\Form\Model\Invoice\Article as FormArticle;
use AppBundle\Form\Type\Invoice\InvoiceType;

class InvoiceController extends Controller
{
    /**
     * @Route("/invoice/issuedInvoices", name="AppBundle_Invoices_issuedInvoices")
     */
    public function issuedInvoicesAction(Request $request)
    {
        // Tu ce se prikazivati svi izdani racuni
        return $this->render('AppBundle:Invoice:issuedInvoices.html.twig');
    }

    /**
     * @Route("/invoice/issueInvoice", name="AppBundle_Invoices_issueInvoice")
     */
    public function issueInvoiceAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();

        $formInvoice = new FormInvoice();

        $form = $this->createForm(
            InvoiceType::class,
            $formInvoice,
            [
                'buyers' => $userAdministration->getBuyers(),
                'operators' => $userAdministration->getOperators(),
                'offices' => $userAdministration->getOffices()
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formInvoice = $form->getData();
            dump($formInvoice);
            // Poziv aplikacijskog servisa koji ce izdati racun
            $this->get('app.application_service.issue_invoice')->issueInvoice($formInvoice, $userAdministration);

            // return $this->redirectToRoute('AppBundle_Invoices_issuedInvoices');
        }

        return $this->render('AppBundle:Invoice:issueInvoice.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/invoice/cancel/{invoiceId}", name="AppBundle_Invoices_cancelInvoice")
     */
    public function cancelInvoiceAction(Request $request, int $invoiceId)
    {
        // Tu ce se pozivati app/domenski servis za tu radnju
        // Poziv aplikacijskog servisa koji ce stornirati racun
        $this->get('app.application_service.cancel_invoice')->cancelInvoice($invoiceId);
        
        return $this->redirectToRoute('AppBundle_Invoices_issuedInvoices'); 
    }
}
