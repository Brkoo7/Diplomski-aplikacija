<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use IssueInvoices\Domain\Model\User\User;

/**
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\InvoiceRepositoryImpl")
 * @ORM\Table(name="invoice")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "FISCAL" = "Invoice",
 *  "FISCAL_VAT" = "VATInvoice",
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
     * Mjesto izdavanja.
     *
     * @var string
     * @ORM\Column(name="issue_place", type="string")
     */
    protected $issuePlace;

    /** 
     * @ORM\Column(type="float")
     */
    protected $baseAmount;

    /** 
     * @ORM\Column(type="float")
     */
    protected $totalAmount;

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
     * @ORM\Column(type="string", nullable=true)
     */
    protected $notes;

    /**
     * @ORM\ManyToOne(targetEntity="IssueInvoices\Domain\Model\User\User", inversedBy="invoices")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /** 
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isCancelled;
    
    public function setIssueDate(DateTime $issueDate)
    {
        $this->issueDate = $issueDate;
    }

    public function setIssuePlace(string $issuePlace)
    {
        $this->issuePlace = $issuePlace;
    }

    public function setBaseAmount(float $baseAmount) 
    {
        $this->baseAmount = $baseAmount;
    }

    public function setTotalAmount(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }
    
    public function setBuyer(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;
    }

    public function addArticleCalculation(ArticleCalculation $articleCalculation)
    {
        $articleCalculation->setInvoice($this);
        $this->articleCalculations->add($articleCalculation);
    }

    public function setUser($user) 
    {
        $this->user = $user;
    }

    public function cancel()
    {
        $this->isCancelled = true;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getIssueDate()
    {
        return $this->issueDate;
    }

    public function getIssuePlace()
    {
        return $this->issuePlace;
    }

    public function getBaseAmount()
    {
        return $this->baseAmount;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
    
    public function getArticleCalculations()
    {
        return $this->articleCalculations;
    }

    public function getSeller()
    {
        return $this->seller;
    }

    public function getBuyer()
    {
        return $this->buyer;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * Da li je račun storniran
     * 
     * @return bool|null
     */
    public function isCancelled()
    {
        return $this->isCancelled;
    }

    /**
     * Da li se radi o storno računu
     */
    public function isCancel(): bool
    {
        if ($this instanceOf CancelInvoice) {
            return true;
        }

        return false;
    }

    public function getType(): string
    {
        if ($this instanceOf CancelInvoice) {
            return 'Storno račun';
        } elseif ($this instanceOf VATInvoice) {
            return 'Fiskalni s PDV-om';
        } else {
            return 'Fiskalni bez PDV-a';
        }
    }
}