<?php
namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;

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
    private $taxRecapitulation;
}