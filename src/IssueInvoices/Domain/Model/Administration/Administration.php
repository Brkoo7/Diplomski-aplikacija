<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use IssueInvoices\Domain\Model\Invoice\BaseInvoice as Invoice;
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

    public function getOperatorById(int $id): Operator
    {
        foreach ($this->operators as $operator) {
            if ($operator->getId() === $id) {
                return $operator;
            }
        }
        return null;
    }

    public function removeOperatorById(int $id)
    {
         foreach ($this->operators as $operator) {
            if ($operator->getId() === $id) {
                $this->operators->removeElement($operator);
            }
        }
    }

    public function getOfficeById(int $id): Office
    {
        foreach ($this->offices as $office) {
            if ($office->getId() === $id) {
                return $office;
            }
        }
        return null;
    }

    public function removeOfficeById(int $id)
    {
         foreach ($this->offices as $office) {
            if ($office->getId() === $id) {
                $this->offices->removeElement($office);
            }
        }
    }

    public function getBuyerById(int $id): Buyer
    {
        foreach ($this->buyers as $buyer) {
            if ($buyer->getId() === $id) {
                return $buyer;
            }
        }
        return null;
    }

    public function removeBuyerById(int $id)
    {
         foreach ($this->buyers as $buyer) {
            if ($buyer->getId() === $id) {
                $this->buyers->removeElement($buyer);
            }
        }
    }

    public function getArticleById(int $id): Article
    {
        foreach ($this->articles as $article) {
            if ($article->getId() === $id) {
                return $article;
            }
        }
        return null;
    }

    public function removeArticleById(int $id)
    {
         foreach ($this->articles as $article) {
            if ($article->getId() === $id) {
                $this->articles->removeElement($article);
            }
        }
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
}