<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Prodavatelj.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\SellerRepositoryImpl")
 * @ORM\Table(name="administration_seller")
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
     * @ORM\Column(type="string", length=20)
     */
    private $country;

    /**
     * Da li je prodavatelj u sustavu PDV-a
     *
     * @var bool
     *
     * @ORM\Column(name="in_vat_system", type="boolean")
     */
    private $inVATSystem;

    /**
     * @ORM\OneToOne(targetEntity="Administration", inversedBy="seller")
     */
    private $administration;


    public function __construct()
    {
        $this->offices = new ArrayCollection();
    }

    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
    }

    public function setPersonName(string $personName)
    {
        $this->personName = $personName;
    }

    public function setOib(string $oib)
    {
        $this->oib = $oib;
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

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setPostalCode(int $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function setInVatSystem(bool $inVATSystem)
    {
        $this->inVATSystem = $inVATSystem;
    }

    public function setAdministration(Administration $administration)
    {
        $this->administration = $administration;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function isInVatSystem(): bool
    {
        return $this->inVATSystem;
    }

    public function getPersonName(): string
    {
        return $this->personName;
    }

    public function getOib(): string
    {
        return $this->oib;
    }

    /**
     * @return string|null
     */
    public function getPdvID()
    {
        return $this->pdvID;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getId(): int
    {
        return $this->id;
    }
}