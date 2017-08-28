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
    private $name = '';

    /**
     * OIB.
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $oib = '';

    /**
     * PDV broj
     *
     * @var string
     * @ORM\Column(name="pdv_id", type="string", length=15)
     */
    private $pdvID = '';

    /**
     * Adresa
     *
     * @var string
     * @ORM\Column(name="address", type="string")
     */
    private $address = '';

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="buyers")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id", nullable=false)
     */
    private $administration;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setOib(string $oib)
    {
        $this->oib = $oib;
    }

    public function setPdvId(string $pdvId)
    {
        $this->pdvId = $pdvId;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function setAdministration($administration)
    {
        $this->administration = $administration;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOib()
    {
        return $this->oib;
    }

    public function getPdvID()
    {
        return $this->pdvID;
    }

    public function getAddress()
    {
        return $this->address;
    }
}