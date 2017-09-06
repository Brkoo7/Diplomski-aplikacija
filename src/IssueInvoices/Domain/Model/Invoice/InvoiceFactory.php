<?php
namespace IssueInvoices\Domain\Model\Invoice;

use IssueInvoices\Domain\Service\InvoiceNumberGenerator;

class InvoiceFactory
{
	private $invoiceNumberGenerator;

    public function __construct(InvoiceNumberGenerator $invoiceNumberGenerator) 
	{
		$this->invoiceNumberGenerator = $invoiceNumberGenerator;
	}

    public function createFromData($data, $administration): BaseInvoice
    {
    	// Treba saznati da li je prodavatelj u sustavu PDV-a
        $seller = $administration->getSeller();
        $isInVatSystem = $seller->isInVatSystem();

    	if ($isInVatSystem) {
    		// Izdajemo fiskalni racun s PDV-om
    		$invoice = new VATInvoice();

    		$this->addBasicMandatoryInfo($invoice, $data, $seller);
        
            // Izracunamo kalkulaciju računa
            $this->doInvoiceCalculation($invoice, $isInVatSystem);
            
            // Izracunamo rekapitulaciju poreza
            $this->calculateTaxRecapitulation($invoice);
    		
    	} else {
    		// Izdajemo fiskalni racun bez PDV-a
    		$invoice = new Invoice();

    		$this->addBasicMandatoryInfo($invoice, $data, $seller);

            // Izracunamo kalkulaciju računa
            $this->doInvoiceCalculation($invoice, $isInVatSystem);
    	}

        return $invoice;
    }

    private function addBasicMandatoryInfo(BaseInvoice $invoice, $data, $seller)
    {
    	$invoice->setIssueDate((new \DateTime()));
    	$invoice->setIssuePlace($data->office->getCity());

    	$this->addBuyerInfo($invoice, $data->buyer);
    	$this->addSellerInfo($invoice, $seller);
    	$this->addArticlesCalculations($invoice, $data->articles);
    	$this->addFiscalInfo($invoice, $data);
    }

    private function addBuyerInfo(BaseInvoice $invoice, $buyerData)
    {
        $buyer = new Buyer(
            $buyerData->getName(),
            $buyerData->getAddress(),
            $buyerData->getOib()
        );

        if ($pdvId = $buyerData->getPdvId()) {
            $buyer->setPdvId($pdvId);
        }
        $invoice->setBuyer($buyer);
    }

    private function addSellerInfo(BaseInvoice $invoice, $sellerData)
    {
        $seller = new Seller(
            $sellerData->getCompanyName(),
            $sellerData->getPersonName(),
            $sellerData->getOib(),
            $sellerData->getStreet(),
            $sellerData->getPostalCode(),
            $sellerData->getCity()
        );

        if ($pdvId = $sellerData->getPdvId()) {
            $seller->setPdvId($pdvId);
        }

        if ($phoneNumber = $sellerData->getPhoneNumber()) {
            $seller->setPhoneNumber($phoneNumber);
        }

        if ($email = $sellerData->getEmail()) {
            $seller->setEmail($email);
        }

        $invoice->setSeller($seller);
    }

    private function addArticlesCalculations(
        BaseInvoice $invoice, 
        array $articles
    ) {
        foreach ($articles as $article) {
            $articleCalculation = new ArticleCalculation(
                $article->article->getName(),
                $article->totalPrice,
                $article->quantity
            );

            if ($discount = $article->discount) {
                $articleCalculation->setDiscount($discount);
            }

            if ($taxRate = $article->taxRate) {
                $articleCalculation->setTaxRate($taxRate);
            }

            // Izracunati jednu kalkulaciju
            $total = $articleCalculation->getUnitPrice() 
                * $articleCalculation->getQuantity();

            if ($discount) {
                $total *= $discount;
            }

            $articleCalculation->setTotal($total);

            $articleCalculation->setInvoice($invoice);
            $invoice->addArticleCalculation($articleCalculation);
        }
    }


    private function addFiscalInfo(BaseInvoice $invoice, $data)
    {
        $invoice->setOperatorName($data->operator->getName());
        $invoice->setOperatorLabel($data->operator->getLabel());
    	$invoice->setOperatorOib($data->operator->getOib());
        $invoice->setPaymentType($data->paymentType->name());

        $officeLabel = $data->office->getLabel();
        $cashRegisterNumber = $data->cashRegister->getNumber();

        // $ordinalNumber = $this->invoiceNumberGenerator->calculateOrdinalNumber($officeLabel, $cashRegisterNumber);

        // $invoiceNumber = new InvoiceNumber($ordinalNumber, $officeLabel, $cashRegisterNumber);

        // $invoice->setNumber($invoiceNumber);
    }

    private function calculateTaxRecapitulation(BaseInvoice $invoice)
    {
    	$totalBaseAmount = 0;
    	$totalTaxAmount = 0;
    	$totalInvoiceAmount = 0;
        $taxRecapitulations = [];

    	foreach ($invoice->getArticleCalculations() as $articleCalculation) {
            $tax = $articleCalculation->getTaxRate();
    		$taxRecapitulations[$tax][] = $articleCalculation->getTotal();
    	}

        foreach ($taxRecapitulations as $taxRate => $totalAmounts) {
            $totalAmount = 0;
            foreach ($totalAmounts as $amount) {
                $totalAmount += $amount;
            }

            $baseAmount = $taxRate * $totalAmount;
            $totalBaseAmount += $baseAmount;

            $taxAmount = $totalAmount - $baseAmount;
            $totalTaxAmount += $taxAmount;

            $taxRecapitulation = new TaxRecapitulation((float) $taxRate, $baseAmount, $taxAmount);
            $invoice->addTaxRecapitulation($taxRecapitulation);
        }

        $invoice->setBaseAmount($totalBaseAmount);
        $invoice->setTaxAmount($totalTaxAmount);
        $invoice->setTotalAmount(($totalBaseAmount + $totalTaxAmount));
    }

    private function doInvoiceCalculation(BaseInvoice $invoice, bool $isInVatSystem)
    {
        $totalAmount = 0;
        $baseAmount = 0;
        $taxAmount = 0;

        foreach ($invoice->getArticleCalculations() as $articleCalculation) {
            $taxRate = $articleCalculation->getTaxRate();
            $totalAmount += $articleCalculation->getTotal();
            $baseAmount += ($totalAmount * $taxRate);
            $taxAmount += ($totalAmount - $baseAmount);
        }

        $invoice->setTotalAmount($totalAmount);
        if ($isInVatSystem) {
            $invoice->setBaseAmount($baseAmount);
            $invoice->setTaxAmount($taxAmount);
        }
    }
}