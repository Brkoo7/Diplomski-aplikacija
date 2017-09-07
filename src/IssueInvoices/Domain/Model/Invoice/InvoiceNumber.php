<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;

/**
 * Broj računa specificiran po Hrvatskom zakonu
 *
 * Format: numerički broj računa|oznaka poslovnog prostora|broj naplatnog uređaja
 *
 * @ORM\Entity
 * @ORM\Table(name="invoice_number")
 */
class InvoiceNumber
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Broj računa.
     *
     * @var int
     * @ORM\Column(name="ordinal", type="integer")
     */
    private $ordinal;

    /**
     * Oznaka poslovnog prostora.
     *
     * @var string
     * @ORM\Column(name="office", type="string")
     */
    private $office;

    /**
     * Oznaka naplatnog uređaja.
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    private $cashRegister;

    public function __construct(int $ordinal, string $officeLabel, int $cashRegisterNumber) 
    {
        $this->ordinal = $ordinal;
        $this->office = $officeLabel;
        $this->cashRegister = $cashRegisterNumber;
    }

    public function getOrdinal()
    {
        return $this->ordinal;
    }

    public function getOffice()
    {
        return $this->office;
    }

    public function getCashRegister()
    {
        return $this->cashRegister;
    }
}
