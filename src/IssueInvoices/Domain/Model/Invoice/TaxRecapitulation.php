<?php
namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="invoice_tax_recapitulation")
 */
class TaxRecapitulation
{
    /**
     * @Orm\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /*
     * @ORM\Column(type="float")
     */
    private $taxRate;

    /*
     * @ORM\Column(type="float")
     */
    private $baseAmount;

    /*
     * @ORM\Column(type="float")
     */
    private $taxAmount;

    /**
     * @var BaseInvoice
     * @ORM\ManyToOne(targetEntity="VATInvoice", inversedBy="taxRecapitulations")
     */
    private $invoice;

    public function __construct(
        float $taxRate, 
        float $baseAmount, 
        float $taxAmount
    ) {
        $this->taxRate = $taxRate;
        $this->baseAmount = $baseAmount;
        $this->taxAmount = $taxAmount;
    }

    public function setInvoice(BaseInvoice $invoice)
    {
        $this->invoice = $invoice;
    }
}