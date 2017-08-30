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
     * Postotak PDV-a
     *
     * @ORM\Column(type="float")
     */
    private $taxRate;

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="articles")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     */
    private $administration;

    public function __construct(string $name, float $totalPrice, float $taxRate)
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->taxRate = $taxRate;
    }

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

    public function setAdministration(Administration $administration) 
    {
        $this->administration = $administration;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function getId(): int
    {
        return $this->id;
    }
}