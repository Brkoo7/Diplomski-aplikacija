<?php

namespace Administration\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Artikl (može biti proizvod ili usluga)
 *
 * @ORM\Entity
 * @ORM\Table(name = "administration_article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Naziv artikla
     *
     * @ORM\Column(type="string", lenght=50)
     */
    private $name;

    /**
     * Cijena artikla
     *
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * Postotak PDV-a (u RH može biti 5, 13, 25)
     *
     * @ORM\Column(type="float")
     */
    private $taxRate;
}