<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Poslovni prostor.
 *
 * @ORM\Entity
 * @ORM\Table(name="diplomski_office")
 */
class Office
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Oznaka prostora
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $label;

    /**
     * Adresa prostora
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @var Seller
     * @ORM\ManyToOne(targetEntity="Seller", inversedBy="offices")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id", nullable=false)
     */
    private $seller;

    /**
     * @var CashRegister
     * @ORM\OneToMany(targetEntity="CashRegister", mappedBy="office")
     */
    private $cashRegisters;

    public function __construct()
    {
        $this->cashRegisters = new ArrayCollection();
    }
}