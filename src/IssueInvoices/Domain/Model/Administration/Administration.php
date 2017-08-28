<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use IssueInvoices\Domain\Model\Invoice\BaseInvoice as Invoice;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Administracija korisnika.
 *
 * @ORM\Entity
 * @ORM\Table(name="administration")
 */
class Administration
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Seller", mappedBy="administration", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $seller;

    /**
     * @var Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="administration", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $articles;

    /**
     * @var Office[]
     * @ORM\OneToMany(targetEntity="Office", mappedBy="administration", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $offices;

    /**
     * @var Buyer[]
     * @ORM\OneToMany(targetEntity="Buyer", mappedBy="administration", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $buyers;

    /**
     * Operateri naplatnih uređaja
     *
     * @var Operator[]
     * @ORM\OneToMany(targetEntity="Operator", mappedBy="administration", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $operators;

    /**
     * @var BaseInvoice[]
     * @ORM\OneToMany(targetEntity="IssueInvoices\Domain\Model\Invoice\BaseInvoice", mappedBy="administration")
     */
    private $invoices;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->offices = new ArrayCollection();
        $this->buyers = new ArrayCollection();
        $this->operators = new ArrayCollection();
        $this->invoices = new ArrayCollection();
    }

    public function addArticle(Article $article) 
    {
        $article->setAdministration($this);
        $this->articles->add($article);
    }

    public function addOffice(Office $office) 
    {
        $office->setAdministration($this);
        $this->offices->add($office);
    }

    public function addBuyer(Buyer $buyer) 
    {
        $buyer->setAdministration($this);
        $this->buyers->add($buyer);
    }

    public function addOperator(Operator $operator) 
    {
        $operator->setAdministration($this);
        $this->operators->add($operator);
    }

    public function getId()
    {
        return $this->id;
    }
}