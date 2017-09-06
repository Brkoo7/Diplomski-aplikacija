<?php
namespace AppBundle\Controller\Invoice;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Model\Invoice\Invoice as FormInvoice;
use AppBundle\Form\Model\Invoice\Article as FormArticle;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\Type\Invoice\InvoiceType;

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
                'offices' => $userAdministration->getOffices(),
                'allArticles' => $userAdministration->getArticles()
            ]
        );
        // \Kint::dump('Ivan');
        // +d("Marko");
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
        // Tu ce se pozivati app/domenski servis za tu radnju
        // Poziv aplikacijskog servisa koji ce stornirati racun
        $this->get('app.application_service.cancel_invoice')->cancelInvoice($invoiceId);

        return $this->redirectToRoute('AppBundle_Invoices_issuedInvoices');
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
