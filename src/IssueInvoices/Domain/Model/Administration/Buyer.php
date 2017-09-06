<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kupac.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\BuyerRepositoryImpl")
 * @ORM\Table(name="administration_buyer")
 */
class Buyer
{
    /**
     * @Orm\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="address", type="string")
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $oib;

    /**
     * PDV ID broj
     * 
     * @var string
     * @ORM\Column(name="pdv_id", type="string", length=15, nullable=true)
     */
    private $pdvID;

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="buyers")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     */
    private $administration;

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * Postavlja OIB broj kupca
     * 
     * @param string|null $oib
     */
    public function setOib($oib)
    {
        $this->oib = $oib;
    }

    /**
     * Postavlja PDV ID broj kupca
     * 
     * @param string|null $oib
     */
    public function setPdvId($pdvID)
    {
        $this->pdvID = $pdvID;
    }

    public function setAdministration(Administration $administration)
    {
        $this->administration = $administration;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getOib()
    {
        return $this->oib;
    }

    /**
     * @return string|null
     */
    public function getPdvId()
    {
        return $this->pdvID;
    }

    public function getAdministration()
    {
        return $this->administration;
    }
}