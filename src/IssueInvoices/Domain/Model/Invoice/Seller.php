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
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="company_name", type="string", length=20)
     */
    protected $companyName = '';

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $personName = '';

    /**
     * OIB.
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    protected $oib = '';

    /**
     * PDV broj
     *
     * @var string
     * @ORM\Column(name="pdv_id", type="string", length=15)
     */
    protected $pdvID = '';

    /**
     * Broj telefona
     *
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=15)
     */
    protected $phoneNumber = '';

    /**
     * E-mail adresa
     *
     * @var string
     * @ORM\Column(name="email", type="string", length=30)
     */
    protected $email = '';

    /**
     * Ulica.
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $street = '';

    /**
     * Poštanski broj.
     *
     * @var int
     * @ORM\Column(name="postal_code", type="integer")
     */
    protected $postalCode;

    /**
     * Grad.
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    protected $city = '';

    /**
     * Država.
     *
     * @var string
     * @ORM\Column(name="country_code", type="string", length=20)
     */
    protected $countryCode = '';

    /**
     * Da li je prodavatelj u sustavu PDV-a
     *
     * @var bool
     *
     * @ORM\Column(name="in_vat_system", type="boolean")
     */
    private $inVATSystem = true;


    public function __construct()
    {
        $this->offices = new ArrayCollection();
    }
}