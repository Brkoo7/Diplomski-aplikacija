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

    public function __construct()
    {
        $this->cashRegisters = new ArrayCollection();
    }

    public function addCashRegister($cashRegister)
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

    public function setAdministration($administration)
    {
        $this->administration = $administration;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCashRegisters()
    {
        return $this->cashRegisters;
    }
}