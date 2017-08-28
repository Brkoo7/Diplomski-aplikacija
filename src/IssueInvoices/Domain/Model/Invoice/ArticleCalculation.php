<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kalkulacija artikla
 *
 * @ORM\Entity
 * @ORM\Table(name = "invoice_article_calculation")
 */
class ArticleCalculation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="BaseInvoice", inversedBy="articleCalculations")
     */
    private $invoiceCalculation;

    /**
     * Naziv artikla
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Ukupni iznos.
     *
     * @var float
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * Porezna osnovica.
     *
     * @var float
     * @ORM\Column(name="tax_basis", type="float")
     */
    private $taxBasic;

    /**
     * Stopa PDV-a.
     *
     * @var float
     * @ORM\Column(name="tax_rate", type="float")
     */
    private $taxRate;

    /**
     * Količina artikla
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * Iznos popusta
     *
     * @ORM\Column(type="string")
     */
    private $discount;
}