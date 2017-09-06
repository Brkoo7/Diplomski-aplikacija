<?php
namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 */
class VATInvoice extends Invoice
{
	/*
     * @ORM\Column(name="base_amount", type="float")
     */
    protected $baseAmount;

    /*
     * @ORM\Column(name="tax_amount", type="float")
     */
    protected $taxAmount;

    /**
     * @var TaxRecapitulation
     * @ORM\OneToMany(targetEntity="TaxRecapitulation", mappedBy="invoice", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $taxRecapitulations;

    public function __construct()
    {
        $this->taxRecapitulations = new ArrayCollection();
        $this->articleCalculations = new ArrayCollection();
    }

    public function setBaseAmount(float $baseAmount) 
    {
        $this->baseAmount = $baseAmount;
    }

    public function setTaxAmount(float $taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    public function addTaxRecapitulation(TaxRecapitulation $taxRecapitulation)
    {
        $this->taxRecapitulations->add($taxRecapitulation);
    }
}