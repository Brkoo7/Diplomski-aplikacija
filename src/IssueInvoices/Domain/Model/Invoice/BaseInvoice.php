<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use User\Domain\Model\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use IssueInvoices\Domain\Model\Administration\Administration;

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
     * @ORM\OneToMany(targetEntity="ArticleCalculation", mappedBy="invoiceCalculation")
     */
    private $articleCalculations;

    /**
     * @var InvoiceCalculation
     * @ORM\OneToOne(targetEntity="InvoiceCalculation", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $invoiceCalculation;

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
    protected $issuePlace = '';

    /**
     * Napomene.
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    protected $notes;

    /**
     * @ORM\ManyToOne(targetEntity="IssueInvoices\Domain\Model\Administration\Administration", inversedBy="invoices")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     */
    private $administration;
}