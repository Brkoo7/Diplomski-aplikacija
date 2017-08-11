<?php

namespace Administration\Domain\Model;

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
     * Naplatni uređaji (blagajne)
     *
     * @var CashRegister[]
     * @ORM\OneToMany(targetEntity="CashRegister", mappedBy="administration")
     */
    private $cashRegisters;

    public function __construct()
    {
        $this->cashRegisters = new ArrayCollection();
    }
}