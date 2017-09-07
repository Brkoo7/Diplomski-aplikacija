<?php
namespace AppBundle\Controller\Invoice;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Invoice\Invoice as FormInvoice;
use AppBundle\Form\Model\Invoice\Article as FormArticle;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\Type\Invoice\InvoiceType;
use IssueInvoices\Domain\Model\Invoice\CancelInvoice;

class InvoiceController extends Controller
{
    /**
     * @Route("/invoice/issuedInvoices", name="AppBundle_Invoices_issuedInvoices")
     */
    public function issuedInvoicesAction(Request $request)
    {
        $userAdministration = $this->getUser()->getAdministration();
        if (!$userAdministration->isReadyForIssueInvoices()) {
        	$this->addFlash(
                'notice',
                'Da bi imali pristup modulu racuna trebate unijeti potrebne podatke!'
            );
            return $this->redirectToRoute('AppBundle_Administration_home');
        }
        $racuni = [];
        $invoices = $this->getUser()->getInvoices();
        foreach ($invoices as $invoice) {
        	$racuni[] = $invoice;
        }
       	// dump($racuni);
       	// exit;

        return $this->render('AppBundle:Invoice:issuedInvoices.html.twig', [
            'invoices' => $invoices
        ]);
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
                'offices' => $userAdministration->getOffices(),
                'allArticles' => $userAdministration->getArticles()
            ]
        );
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	// dump($form->getData());
            $formInvoice = $form->getData();
            // Poziv aplikacijskog servisa koji ce izdati racun
            $this->get('app.application_service.issue_invoice')->issueInvoice($formInvoice, $userAdministration);

            return $this->redirectToRoute('AppBundle_Invoices_issuedInvoices');
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
        // Poziv aplikacijskog servisa koji ce stornirati racun
        $this->get('app.application_service.cancel_invoice')->cancelInvoice($invoiceId);

        return $this->redirectToRoute('AppBundle_Invoices_issuedInvoices');
    }

    /**
     * @Route("/invoice/{invoiceId}", name="AppBundle_Invoice_viewInvoice")
     */
    public function viewInvoiceAction(Request $request, int $invoiceId)
    {
        $invoice = $this->get('app.invoice_repository')->find($invoiceId);
        $isCancel = false;
        // Saznati da li je racun storno
        if ($invoice instanceOf CancelInvoice) {
        	$isCancel = true;
        }

        if ($isCancel) {
        	return $this->render('AppBundle:Invoice:viewCancelInvoice.html.twig', [
            	'invoice' => $invoice
        	]);
        }
        else {
        	return $this->render('AppBundle:Invoice:viewInvoice.html.twig', [
            	'invoice' => $invoice
        	]);
    	}
    }

    /**
     * @Route("/ajax/changeOffice", name="AppBundle_Invoice_changeOffice")
     */
    public function changeOfficeAction(Request $request)
    {
        $officeId = (int)$request->query->get('officeId');

        // Dohvati sve blagajne poslovnog prostora
        $cashRegisters = $this->get('app.cashRegister_repository')
                ->findForOffice($officeId);

        return $this->render('AppBundle:Invoice:cashRegisters.html.twig', [
                'cashRegisters' => $cashRegisters
        ]);
    }

    /**
     * @Route("/ajax/changeArticle", name="AppBundle_Invoice_changeArticle")
     */
    public function changeArticleAction(Request $request)
    {
        $articleId = (int) $request->query->get('articleId');

        $article = $this->get('app.article_repository')->find($articleId);
        $articleData = [
            'price' => $article->getTotalPrice(),
            'tax' => $article->getTaxRate()
        ];

        return new JsonResponse($articleData);
    }
}
