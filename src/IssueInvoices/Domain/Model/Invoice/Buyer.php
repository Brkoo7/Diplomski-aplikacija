<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kupac.
 *
 * @ORM\Entity
 * @ORM\Table(name="invoice_buyer")
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
     * Adresa
     *
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
}