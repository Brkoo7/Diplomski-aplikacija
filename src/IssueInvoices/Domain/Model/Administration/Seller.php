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
     * @ORM\Column(name="company_name", type="string", length=20)
     */
    private $companyName = '';

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $personName = '';

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
     * Broj telefona
     *
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=15)
     */
    private $phoneNumber = '';

    /**
     * E-mail adresa
     *
     * @var string
     * @ORM\Column(name="email", type="string", length=30)
     */
    private $email = '';

    /**
     * Ulica.
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $street = '';

    /**
     * Poštanski broj.
     *
     * @var int
     * @ORM\Column(name="postal_code", type="integer")
     */
    private $postalCode;

    /**
     * Grad.
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $city = '';

    /**
     * Država.
     *
     * @var string
     * @ORM\Column(name="country_code", type="string", length=20)
     */
    private $countryCode = '';

    /**
     * Da li je prodavatelj u sustavu PDV-a
     *
     * @var bool
     *
     * @ORM\Column(name="in_vat_system", type="boolean")
     */
    private $inVATSystem = true;

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

    public function setPdvID(string $pdvID)
    {
        $this->pdvID = $pdvID;
    }

    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function setInVatSystem(bool $inVatSystem)
    {
        $this->inVatSystem = $inVatSystem;
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

    public function getIsInVATSystem()
    {
        return $this->inVATSystem;
    }
}