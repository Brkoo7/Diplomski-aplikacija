<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Kupac.
 *
 * @ORM\Entity
 * @ORM\Table(name="invoice_buyer")
 */
class Buyer
{
    /**
     * @Orm\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $name = '';

    /**
     * OIB.
     *
     * @var string
     * @ORM\Column(type="string", length=15)
     */
    private $oib = '';

    /**
     * PDV broj
     *
     * @var string
     * @ORM\Column(name="pdv_id", type="string", length=15)
     */
    private $pdvID = '';

    /**
     * Adresa
     *
     * @var string
     * @ORM\Column(name="address", type="string")
     */
    private $address = '';
}