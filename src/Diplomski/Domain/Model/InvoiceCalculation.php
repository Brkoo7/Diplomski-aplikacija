<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Kalkulacija računa
 *
 * @ORM\Entity
 * @ORM\Table(name = "diplomski_invoice_calculation")
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
     * Kalkulacija artikala.
     *
     * @var iterable<ArticleCalculation>
     * @ORM\OneToMany(targetEntity="ArticleCalculation", mappedBy="invoiceCalculation")
     */
    private $articleCalculations;

    /**
     * Valuta
     *
     * @ORM\Column(type="string")
     */
    private $currency;

    // Tu će biti metode za izračun osnovice, poreza, ukupnog iznosa
    //
    public function __construct()
    {
        $this->articleCalculations = new ArrayCollection();
    }
}