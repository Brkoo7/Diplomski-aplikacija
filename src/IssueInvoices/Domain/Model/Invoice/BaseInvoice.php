<?php
namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use IssueInvoices\Domain\Model\User\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="invoice")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "ORDINAL" = "OrdinalInvoice",
 *  "FISCAL" = "FiscalInvoice",
 *  "CANCEL" = "CancelInvoice"
 * })
 */
abstract class BaseInvoice
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Datum i vrijeme izdavanja.
     *
     * @var DateTime
     * @ORM\Column(name="issue_date", type="datetime")
     */
    protected $issueDate;

    /**
     * Prodavatelj.
     *
     * @var Seller
     * @ORM\OneToOne(targetEntity="Seller", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $seller;

    /**
     * Kupac.
     *
     * @var Buyer
     * @ORM\OneToOne(targetEntity="Buyer", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $buyer;

    /**
     * @var ArticleCalculation
     * @ORM\OneToMany(targetEntity="ArticleCalculation", mappedBy="invoice", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $articleCalculations;

    /**
     * Vrsta računa.
     *
     * @var InvoiceType
     * @ORM\Column(name="invoice_type", type="string", nullable=true)
     */
    protected $invoiceType;

    /**
     * Mjesto izdavanja.
     *
     * @var string
     * @ORM\Column(name="issue_place", type="string")
     */
    protected $issuePlace;

    /**
     * Napomene.
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    protected $notes;

    /* 
     * @var float
     * @ORM\Column(name="base_amount", type="float")
     */
    protected $baseAmount;

    /* 
     * @var float
     * @ORM\Column(name="tax_amount", type="float")
     */
    protected $taxAmount;

    /* 
     * @var float
     * @ORM\Column(name="total_amount", type="float")
     */
    protected $totalAmount;

    /**
     * @ORM\ManyToOne(targetEntity="IssueInvoices\Domain\Model\User\User", inversedBy="invoices")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    public function __construct()
    {
        $this->articleCalculations = new ArrayCollection();
    }
}