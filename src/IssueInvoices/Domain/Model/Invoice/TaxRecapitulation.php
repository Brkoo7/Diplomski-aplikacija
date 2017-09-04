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
     * @ORM\ManyToOne(targetEntity="BaseInvoice", inversedBy="taxRecapitulations)
     */
    private $invoice;

    public function setInvoice(BaseInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function setTaxRate(float $taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function setBaseAmount(float $baseAmount)
    {
        $this->baseAmount = $baseAmount;
    }

    public function setTaxAmount(float $taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }
}