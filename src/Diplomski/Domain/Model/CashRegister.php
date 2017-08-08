<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Naplatni uređaj.
 *
 * @ORM\Entity
 * @ORM\Table(name="diplomski_cash_register")
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
     * @var Office
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="cashRegisters")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id")
     */
    private $office;

    /**
     * @var Operator
     * @ORM\OneToOne(targetEntity="Operator", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="operator_id", referencedColumnName="id")
     */
    private $operator;
}