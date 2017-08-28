<?php

namespace IssueInvoices\Domain\Model\Administration;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Operator.
 *
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\OperatorRepositoryImpl")
 * @ORM\Table(name="administration_operator")
 */
class Operator
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $oib;

    /**
     * Oznaka operatera
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $label;

    /**
     * Ime i prezime
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Administration", inversedBy="operators")
     * @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     */
    private $administration;

    public function setOib(string $oib)
    {
        $this->oib = $oib;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setAdministration($administration)
    {
        $this->administration = $administration;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getOib()
    {
        return $this->oib;
    }

    public function getId()
    {
        return $this->id;
    }
}