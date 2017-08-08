<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Klasa računa
 *
 * @ORM\Entity(repositoryClass="Infrastructure\Doctrine2\InvoiceRepositoryImpl")
 * @ORM\Table(name = "diplomski_invoice")
 */
class Invoice
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
     * Broj računa.
     *
     * @var Number
     * @ORM\OneToOne(targetEntity="InvoiceNumber", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $number;

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
     * Način plaćanja.
     *
     * @var PaymentType
     * @ORM\Column(name="payment_type", type="string", nullable=true)
     */
    private $paymentType;

    /**
     * Ime i prezime operatera.
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $operatorName;

    /**
     * Mjesto izdavanja.
     *
     * @var string
     * @ORM\Column(name="issue_place", type="string")
     */
    protected $issuePlace = '';

    /**
     * Zaštitni kod izdavatelja računa.
     *
     * @var string|null
     * @ORM\Column(name="zki_code", type="string", nullable=true)
     */
    private $ZKICode;

    /**
     * Jedinistveni identifikator računa.
     *
     * @var string|null
     * @ORM\Column(name="jir_code", type="string", nullable=true)
     */
    private $JIRCode;

    /**
     * Napomene.
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $notes;
}