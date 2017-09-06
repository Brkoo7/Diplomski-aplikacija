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
 *  "ORDINAL" = "Invoice",
 *  "VAT" = "VATInvoice",
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
     * @ORM\Column(name="total_amount", type="float")
     */
    protected $totalAmount;

    /**
     * @ORM\ManyToOne(targetEntity="IssueInvoices\Domain\Model\User\User", inversedBy="invoices")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function addArticleCalculation(ArticleCalculation $articleCalculation)
    {
        $articleCalculation->setInvoice($this);
        $this->articleCalculations->add($articleCalculation);
    }

    public function setIssueDate(DateTime $issueDate)
    {
        $this->issueDate = $issueDate;
    }

    public function setIssuePlace(string $issuePlace)
    {
        $this->issuePlace = $issuePlace;
    }

    public function setBuyer(Buyer $buyer)
    {
        $this->buyer = $buyer;
    }

    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;
    }

    public function getArticleCalculations()
    {
        return $this->articleCalculations;
    }

    public function setTotalAmount(float $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }
}