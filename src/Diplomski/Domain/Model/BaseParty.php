<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bazna klasa stranke računa (prodavatelj ili kupac)
 *
 * @ORM\Entity
 * @ORM\Table(name="diplomski_base_party")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="party_type", type="string")
 * @ORM\DiscriminatorMap({
 *  "SELLER" = "Seller",
 *  "BUYER" = "Buyer"
 * })
 */
abstract class BaseParty
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
}
