<?php

namespace Invoice\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use User\Domain\Model\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="invoice")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "PLAIN" = "PlainInvoice",
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
    private $id;

    /**
     * Datum i vrijeme izdavanja.
     *
     * @var DateTime
     * @ORM\Column(name="issue_date", type="datetime")
     */
    private $issueDate;

    /**
     * Prodavatelj.
     *
     * @var Seller
     * @ORM\OneToOne(targetEntity="Seller", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $seller;

    /**
     * Kupac.
     *
     * @var Buyer
     * @ORM\OneToOne(targetEntity="Buyer", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $buyer;

    /**
     * @var InvoiceCalculation
     * @ORM\OneToOne(targetEntity="InvoiceCalculation", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $invoiceCalculation;

    /**
     * Vrsta računa.
     *
     * @var InvoiceType
     * @ORM\Column(name="invoice_type", type="string", nullable=true)
     */
    private $invoiceType;

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
    private $notes;
}