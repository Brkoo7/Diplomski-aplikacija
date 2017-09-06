<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Naplatni uređaj.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\CashRegisterRepositoryImpl")
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
     * Broj naplatnog uređaja
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @var Office
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="cashRegisters")
     */
    private $office;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function setOffice(Office $office)
    {
        $this->office = $office;
    }

    public function setNumber(int $number)
    {
        $this->label = $label;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getOffice(): Office
    {
        return $this->office;
    }

    public function getId(): int
    {
        return $this->id;
    }
}