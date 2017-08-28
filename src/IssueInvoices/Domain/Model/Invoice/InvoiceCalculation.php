<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Kalkulacija računa
 *
 * @ORM\Entity
 * @ORM\Table(name = "invoice_calculation")
 */
class InvoiceCalculation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Valuta
     *
     * @ORM\Column(type="string")
     */
    private $currency;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $baseAmount;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $taxAmount;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $totalAmount;

    // Tu će biti metode za izračun osnovice, poreza, ukupnog iznosa
    //
    public function __construct()
    {
        $this->articleCalculations = new ArrayCollection();
    }
}