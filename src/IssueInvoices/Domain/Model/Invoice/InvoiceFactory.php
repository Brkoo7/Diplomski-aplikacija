<?php
namespace IssueInvoices\Domain\Model\Invoice;

class InvoiceFactory
{
	public function __construct() 
	{
		// Injectati servis generator broja racuna
	}

    public function createFromData($data, $administration)
    {
    	// Treba saznati da li je prodavatelj u sustavu PDV-a
    	$isInVatSystem = $administration->getSeller()->isInVatSystem();

    	if ($isInVatSystem) {
    		// Izdajemo fiskalni racun s PDV-om
    		$invoice = new Invoice();

    		$this->addBasicMandatoryInfo($invoice, $data);

    		// Izracunamo kalkulaciju racuna
    		// Prolazimo kroz kalkulaciju artikala
    		$invoiceTotalAmount = 0;
    		foreach ($invoice->getArticleCalculations() as $articleCalculation) {
    			$invoiceTotalAmount += $articleCalculation->getTotal();
    		}
    		$invoice->setTotalPrice($invoiceTotalAmount);
    		
    	} else {
    		// Izdajemo fiskalni racun bez PDV-a
    		$invoice = new VATInvoice();

    		$this->addBasicMandatoryInfo($invoice, $data);

    		// Izracunamo kalkulaciju racuna
    		// Izracunamo por. osnovicu, porez, te ukupan iznos
    		// Izracunamo rekapitulaciju poreza
    		$this->addTaxRecapitulations($invoice, $invoice->articleCalculations());
    		
    	}
    }

    private function addBasicMandatoryInfo(BaseInvoice $invoice, $data)
    {
    	$invoice->setIssueDate((new DateTime())->now());
    	$invoice->setIssuePlace('Split');

    	$this->addBuyerInfo($invoice, $data->buyer);
    	$this->addSellerInfo($invoice, $administration->getSeller());
    	$this->addArticlesCalculations($invoice, $data->articles);

    	$this->addFiscalInfo($invoice, $data);
    }

    private function addArticlesCalculations(
    	BaseInvoice $invoice, 
    	array $articles
    )
    {
    	foreach ($articles as $article) {
    		$articleCalculation = new ArticleCalculation(
    			$article->name,
    			$article->unitPrice,
    			$article->quantity,
    			$article->discount,
    			$baseInvoice
    		);

			$articleCalculation->setTotal(
    			$article->unitPrice * $article->quantity * $article->discount
    		);

    		$articleCalculation->setTaxRate($article->taxRate);

    		$invoice->addArticleCalculation($articleCalculation);
    	}
    }

    private function addBuyerInfo(BaseInvoice $invoice, $buyerData)
    {

    }

    private function addSellerInfo(BaseInvoice $invoice, $sellerData)
    {

    }

    private function addFiscalInfo(BaseInvoice $invoice, $data)
    {
    	// Pozvati domenski servis za generiranje broja racuna
    	// dohvatiti
    	// $this->invoiceNumberGeneratorService($data->office->getLabel(), $data->operator->getLabel())
    	// Dobit cemo $invoiceNumber['ordinal':
    	// 			   'officeLabel'
    	// 			   'operatorLabel'
    	// 			  ]

    	// $invoiceNumber = new InvoiceNumber($invoiceNumber['ordinal'], 
    	// $invoiceNUmber['officeLabel'], $invoiceNumber['operatorLabel']);

    	// $invoice->setNumber($invoiceNumber);
    	// $invoice->setOperatorName($data->operator->getName());
    	// $invoice->setOperatorOib($data->operator->getOib());
    	// $invoice->setPaymentType($data->paymentType);
    	// $invoice->setZKICode(414141414214);
    	// $invoice->setJIRCode(1241241241414);
    }

    private function addTaxRecapitulation(BaseInvoice $invoice, array $articleCalculations)
    {
    	$baseAmount;
    	$taxAmount;
    	$totalAmount;
    	foreach ($articleCalculations as $calculation) {
    		// Pronaci koliki je PDV artikla
    		// Spremiti u niz $taxRecapitulation[$rate][] = $calculation->getTotal()
    	}

    	// Izracunati totalamount, Proci kroz svaki $taxRecapitulation[$rate][]
    	// $invoice->addTaxRecapitulation($taxRecapitulation)
    }
}