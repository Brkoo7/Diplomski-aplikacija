<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Prodavatelj.
 *
 * @ORM\Entity
 * @ORM\Table(name="invoice_seller")
 */
class Seller
{
    /**
     * @Orm\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="company_name", type="string", length=50)
     */
    private $companyName;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $personName;

    /**
     * OIB.
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $oib;

    /**
     * PDV broj
     *
     * @var string
     * @ORM\Column(name="pdv_id", type="string", length=15, nullable=true)
     */
    private $pdvID;

    /**
     * Broj telefona
     *
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=20, nullable=true)
     */
    private $phoneNumber;

    /**
     * E-mail adresa
     *
     * @var string
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * Ulica.
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $street;

    /**
     * Poštanski broj.
     *
     * @var int
     * @ORM\Column(name="postal_code", type="integer")
     */
    private $postalCode;

    /**
     * Mjesto.
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $city;

    /**
     * Država.
     *
     * @var string
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $country;

    public function __construct(
        string $companyName, 
        string $personName,
        string $oib,
        string $street,
        int $postalCode,
        string $city
    ) {
        $this->companyName = $companyName;  
        $this->personName = $personName;
        $this->oib = $oib;
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
    }

    public function setPdvID($pdvID)
    {
        $this->pdvID = $pdvID;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function getPersonName()
    {
        return $this->personName;
    }

    public function getOib()
    {
        return $this->oib;
    }

    public function getPdvID()
    {
        return $this->pdvID;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCity()
    {
        return $this->city;
    }
}