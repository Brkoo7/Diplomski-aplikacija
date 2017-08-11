<?php

namespace Administration\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Naplatni uređaj.
 *
 * @ORM\Entity
 * @ORM\Table(name="administration_cash_register")
 */
class CashRegister
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Oznaka uređaja
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $label;

    /**
     * Operateri naplatnih uređaja
     *
     * @var Operator[]
     * @ORM\OneToMany(targetEntity="Operator", mappedBy="cashRegister")
     */
    private $operators;

    /**
     * @var Office
     * ORM\ManyToOne(targetEntity="Office", inversedBy="cashRegisters")
     */
    private $office;

    public function __construct()
    {
        $this->operators = new ArrayCollection();
    }
}