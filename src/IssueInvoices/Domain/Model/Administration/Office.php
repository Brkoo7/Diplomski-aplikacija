<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Poslovni prostor.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\OfficeRepositoryImpl")
 * @ORM\Table(name="administration_office")
 */
class Office
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Oznaka prostora
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $label;

    /**
     * Adresa prostora
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * Mjesto prostora
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * Naplatni uređaji (blagajne)
     *
     * @var CashRegister[]
     * @ORM\OneToMany(targetEntity="CashRegister", mappedBy="office")
     */
    private $cashRegisters;

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="offices")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     */
    private $administration;

    public function __construct(string $label, string $address, string $city)
    {
        $this->cashRegisters = new ArrayCollection();
        $this->label = $label;
        $this->address = $address;
        $this->city = $city;
    }

    public function addCashRegister(CashRegister $cashRegister)
    {
        $cashRegister->setOffice($this);
        $this->cashRegisters->add($cashRegister);
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function setAdministration(Administration $administration)
    {
        $this->administration = $administration;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCashRegisters()
    {
        return $this->cashRegisters;
    }
}