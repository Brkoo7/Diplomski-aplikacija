<?php
namespace AppBundle\Controller\Invoice;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/invoice/new", name="AppBundle_Invoices_addInvoice")
     */
    public function newInvoiceAction(Request $request)
    {
        // Tu ce se dodavati novi racuni
        $userAdministration = $this->getUser()->getAdministration();
        

        return $this->render('AppBundle:Administration:home.html.twig', [
            'status' => $status
        ]);
    }

    /**
     * @Route("/invoice/cancel", name="AppBundle_Invoices_cancelInvoice")
     */
    public function cancelInvoiceAction(Request $request)
    {
        // Tu ce se dodavati novi racuni
        $userAdministration = $this->getUser()->getAdministration();
        

        return $this->render('AppBundle:Administration:home.html.twig', [
            'status' => $status
        ]);
    }
}
