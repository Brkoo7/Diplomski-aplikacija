<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class CashRegister
{
    /**
     * @Assert\NotBlank
     * @Assert\Type(type="int")
     */
    public $number;

    /**
     * @Assert\NotBlank
     */
    public $office;
}