<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Artikl (može biti proizvod ili usluga)
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\ArticleRepositoryImpl")
 * @ORM\Table(name = "administration_article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Naziv artikla
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * Cijena artikla
     *
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * Postotak PDV-a (u RH može biti 5, 13, 25)
     *
     * @ORM\Column(type="float")
     */
    private $taxRate;

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="articles")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id", nullable=false)
     */
    private $administration;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setTotalPrice(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function setTaxRate(float $taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function setAdministration($administration) 
    {
        $this->administration = $administration;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getTaxRate()
    {
        return $this->taxRate;
    }

    public function getId()
    {
        return $this->id;
    }
}