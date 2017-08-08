<?php

namespace Diplomski\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Prodavatelj.
 *
 * @ORM\Entity
 */
class Seller extends BaseParty
{
    /**
     * Poslovni prostor
     *
     * @var Office
     *
     * @ORM\OneToMany(targetEntity="Office", mappedBy="seller")
     */
    private $offices;

    /**
     * Da li je prodavatelj u sustavu PDV-a
     *
     * @var bool
     *
     * @ORM\Column(name="in_vat_system", type="boolean")
     */
    private $inVATSystem = true;

    public function __construct()
    {
        $this->offices = new ArrayCollection();
    }
}