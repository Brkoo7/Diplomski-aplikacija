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
            $invoice->setUser($administration->getUser());
    		$this->addBasicMandatoryInfo($invoice, $data, $seller);
        
            // Izracunamo kalkulaciju računa
            $this->doInvoiceCalculation($invoice, $isInVatSystem);
            
            // Izracunamo rekapitulaciju poreza
            $this->calculateTaxRecapitulation($invoice);
    		
    	} else {
    		// Izdajemo fiskalni racun bez PDV-a
    		$invoice = new Invoice();
            $invoice->setUser($administration->getUser());
    		$this->addBasicMandatoryInfo($invoice, $data, $seller);

            // Izracunamo kalkulaciju računa
            $this->doInvoiceCalculation($invoice, $isInVatSystem);
    	}

        return $invoice;
    }

    public function createCancelFromOriginalInvoice(BaseInvoice $invoice): CancelInvoice
    {
        $cancelInvoice = new CancelInvoice();
        $cancelInvoice->setRelatedInvoice($invoice);

        $cancelInvoice->setIssueDate((new \DateTime()));
        $cancelInvoice->setIssuePlace($invoice->getIssuePlace());

        // Pridjeljivanje podataka trenutnog operatera
        $cancelInvoice->setOperatorLabel('NOVI');
        $cancelInvoice->setOperatorName('NOVI');
        $cancelInvoice->setOperatorOib('523523523523532523');

        $cancelInvoice->setBaseAmount(-($invoice->getBaseAmount()));
        $cancelInvoice->setTotalAmount(-($invoice->getTotalAmount()));

        $cancelInvoice->setPaymentType($invoice->getPaymentType());
        
        // Generiranje broja računa
        $officeLabel = $invoice->getNumber()->getOffice();
        $cashRegisterNumber = $invoice->getNumber()->getCashRegister();

        $cancelInvoice->setNumber(
            $this->generateInvoiceNumber(
                $officeLabel, 
                $cashRegisterNumber,
                $invoice->getUser()->getId()
            )
        );
        $cancelInvoice->setUser($invoice->getUser());

        return $cancelInvoice;
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
                $totalDiscount = $total * ($discount/100);
                $total = $total - $totalDiscount;
            }

            $articleCalculation->setTotal($total);

            $articleCalculation->setInvoice($invoice);
            $invoice->addArticleCalculation($articleCalculation);
        }
    }

    private function addFiscalInfo(BaseInvoice $invoice, $data)
    {
        $invoice->setOperatorLabel($data->operator->getLabel());
        $invoice->setOperatorName($data->operator->getName());
    	$invoice->setOperatorOib($data->operator->getOib());
        $invoice->setPaymentType(new PaymentType($data->paymentType));

        $officeLabel = $data->office->getLabel();
        $cashRegisterNumber = $data->cashRegister->getNumber();
        $invoice->setNumber(
            $this->generateInvoiceNumber(
                $officeLabel, 
                $cashRegisterNumber,
                $invoice->getUser()->getId()
            )
        );
    }

    private function doInvoiceCalculation(BaseInvoice $invoice, bool $isInVatSystem)
    {
        $invoiceTotalAmount = 0;
        $invoiceBaseAmount = 0;
        $invoiceTaxAmount = 0;

        foreach ($invoice->getArticleCalculations() as $articleCalculation) {
            $articleTaxRate = $articleCalculation->getTaxRate();
            $articleTotalAmount = $articleCalculation->getTotal();
            $articleTaxAmount = $articleTotalAmount * ($articleTaxRate/100);
            $articleBaseAmount = $articleTotalAmount - $articleTaxAmount;

            $invoiceTotalAmount += $articleTotalAmount;
            $invoiceBaseAmount += $articleBaseAmount;
            $invoiceTaxAmount += $articleTaxAmount;
        }

        $invoice->setTotalAmount($invoiceTotalAmount);
        if ($isInVatSystem) {
            $invoice->setTaxAmount($invoiceTaxAmount);
            $invoice->setBaseAmount($invoiceBaseAmount);
        } else {
            $invoice->setTotalAmount($invoiceTotalAmount);
            $invoice->setBaseAmount($invoiceTotalAmount);
        }
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

            $taxAmount = round($totalAmount * ($taxRate/100), 2);
            $baseAmount = $totalAmount - $taxAmount;

            $taxRecapitulation = new TaxRecapitulation($taxRate, $baseAmount, $taxAmount);
            $invoice->addTaxRecapitulation($taxRecapitulation);
        }
    }

    private function generateInvoiceNumber(
        string $officeLabel, 
        int $cashRegisterNumber,
        int $userId
    ): InvoiceNumber
    {
        
        $ordinalNumber = $this->invoiceNumberGenerator->calculateOrdinalNumber($officeLabel, $cashRegisterNumber, $userId);

        return new InvoiceNumber($ordinalNumber, $officeLabel, $cashRegisterNumber);
    }
}