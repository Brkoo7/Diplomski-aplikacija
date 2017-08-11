<?php

namespace Administration\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Operator.
 *
 * @ORM\Entity
 * @ORM\Table(name="diplomski_operator")
 */
class Operator
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", lenght=15)
     */
    private $oib;

    /**
     * Oznaka operatera
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var CashRegister
     * @ORM\ManyToOne(targetEntity="CashRegister", inversedBy="operators")
     */
    private $cashRegister;
}