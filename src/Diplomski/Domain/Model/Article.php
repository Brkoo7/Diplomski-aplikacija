<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Artikl (može biti proizvod ili usluga)
 *
 * Tablica koja stoji zasebno odnosno nije povezana s nijednim entitetom.
 *
 * @ORM\Entity
 * @ORM\Table(name = "diplomski_article")
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Cijena artikla
     *
     * @ORM\Column(type="float")
     */
    private $totalPrice;

    /**
     * Iznos PDV-a
     *
     * @ORM\Column(type="float")
     */
    private $taxRate;
}