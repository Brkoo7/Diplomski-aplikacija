<?php
namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Fiskalni račun s PDV-om
 * @ORM\Entity
 */
class VATInvoice extends Invoice
{
    /** 
     * @ORM\Column(type="float")
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

    public function setTaxAmount(float $taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    public function addTaxRecapitulation(TaxRecapitulation $taxRecapitulation)
    {
        $taxRecapitulation->setInvoice($this);
        $this->taxRecapitulations->add($taxRecapitulation);
    }

    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    public function getTaxRecapitulations()
    {
        return $this->taxRecapitulations;
    }
}