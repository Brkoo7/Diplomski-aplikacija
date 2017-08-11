<?php

namespace Invoice\Domain\Model;

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
     * @ORM\ManyToOne(targetEntity="InvoiceCalculation", inversedBy="articleCalculations")
     */
    private $invoiceCalculation;

    /**
     * Naziv artikla
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Cijena artikla
     *
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Količina artikla
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * Postotak PDV-a
     *
     * @ORM\Column(type="float")
     */
    private $vatRate;

    /**
     * Iznos popusta
     *
     * @ORM\Column(type="string")
     */
    private $discount;
}