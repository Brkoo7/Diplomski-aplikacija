<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class CashRegister
{
    /**
     * @Assert\NotBlank
     */
    public $label;

    /**
     * @Assert\NotBlank
     */
    public $office;
}