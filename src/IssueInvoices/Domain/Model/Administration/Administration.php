<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use IssueInvoices\Domain\Model\User\User;
use DateTime;

/**
 * Administracija korisnika.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\AdministrationRepositoryImpl")
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
     * @var Seller
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
     * @var User
     * @ORM\OneToOne(targetEntity="IssueInvoices\Domain\Model\User\User", inversedBy="administration")
     */
    private $user;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->offices = new ArrayCollection();
        $this->buyers = new ArrayCollection();
        $this->operators = new ArrayCollection();
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setSeller(Seller $seller) 
    {
        $seller->setAdministration($this);
        $this->seller = $seller;
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function getBuyers()
    {
        return $this->buyers;
    }

    public function getSeller()
    {
        return $this->seller;
    }

    public function getOffices()
    {
        return $this->offices;
    }

    public function getOperators()
    {
        return $this->operators;
    }

    public function getAllCashRegisters()
    {
        $cashRegisters = [];
        foreach ($this->offices as $office) {
            foreach ($office->getCashRegisters() as $register) {
                $cashRegisters[] = $register;
            }
        }
        return $cashRegisters;
    }

    public function isExistSeller(): bool
    {
        return $this->getSeller() ? true : false;
    }

    public function isExistOffice(): bool
    {
        return count($this->getOffices()) ? true : false;
    }

    public function isExistCashRegister(): bool
    {
        $offices = $this->getOffices();
        foreach ($offices as $office) {
            if (count($office->getCashRegisters()) >= 1) {
                return true;
            }
        }

        return false;
    }

    public function isExistOperator(): bool
    {
        return count($this->getOperators()) ? true : false;
    }

    public function isReadyForIssueInvoices(): bool
    {
        if ($this->isExistOperator() 
            && $this->isExistOffice() 
            && $this->isExistSeller() 
            && $this->isExistCashRegister()) {
            return true;
        } else {
            return false;
        }
    }
}