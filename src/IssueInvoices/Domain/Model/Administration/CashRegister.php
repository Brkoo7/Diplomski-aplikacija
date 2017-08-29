<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
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
     * @var Office
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="cashRegisters")
     */
    private $office;

    public function setOffice($office)
    {
        $this->office = $office;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getOffice()
    {
        return $this->office;
    }
}