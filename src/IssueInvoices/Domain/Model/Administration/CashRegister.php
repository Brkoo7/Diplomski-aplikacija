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

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public function setOffice(Office $office)
    {
        $this->office = $office;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getLabel(): string
    {
        return $this->label;
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