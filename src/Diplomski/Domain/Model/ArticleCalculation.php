<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kalkulacija artikla
 *
 * @ORM\Entity
 * @ORM\Table(name = "diplomski_article_calculation")
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
     *
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
     * Cijena artikla s PDV-om
     *
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * Količina artikla
     *
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * Iznos PDV-a
     *
     * @ORM\Column(type="string")
     */
    private $vatRate;

    /**
     * Iznos popusta
     *
     * @ORM\Column(type="string")
     */
    private $discount;
}