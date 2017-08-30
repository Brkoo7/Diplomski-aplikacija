<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kalkulacija artikla
 *
 * @ORM\Entity
 * @ORM\Table(name = "invoice_article_calculation")
 */
class ArticleCalculation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Naziv artikla
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Jedinična cijena.
     *
     * @var float
     * @ORM\Column(name="unit_price", type="float")
     */
    private $unitPrice;

    /**
     * Stopa PDV-a.
     *
     * @var float
     * @ORM\Column(name="tax_rate", type="float")
     */
    private $taxRate;

    /**
     * Ukupni iznos.
     *
     * @var float
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * Količina artikla
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * Iznos popusta
     *
     * @ORM\Column(type="float")
     */
    private $discount;

    /**
     * @var BaseInvoice
     * @ORM\ManyToOne(targetEntity="BaseInvoice", inversedBy="articleCalculations")
     */
    private $invoice;

    public function setInvoice(BaseInvoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setUnitPrice(string $unitPrice)
    {
        $this->unitPrice = $unitPrice;
    }

    public function setTaxRate(float $taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function setTotal(float $total)
    {
        $this->total = $total;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function setDiscount(float $discount)
    {
        $this->discount = $discount;
    }
}