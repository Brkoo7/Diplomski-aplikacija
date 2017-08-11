<?php

namespace Administration\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Administracija.
 *
 * @ORM\Entity
 * @ORM\Table(name="administration")
 */
class Administration
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Seller")
     */
    private $seller;

    /**
     * @var Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="administration")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="Office", mappedBy="administration")
     */
    private $offices;

    /**
     * @ORM\OneToMany(targetEntity="Buyer", mappedBy="administration")
     */
    private $buyers;
}