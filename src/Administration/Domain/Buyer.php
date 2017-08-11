<?php

namespace Administration\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kupac.
 *
 * @ORM\Entity
 * @ORM\Table(name="administration_buyer")
 */
class Buyer
{
    /**
     * @Orm\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    protected $name = '';

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
     * Adresa
     *
     * @var string
     * @ORM\Column(name="address", type="string")
     */
    protected $address = '';
}