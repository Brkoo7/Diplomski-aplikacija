<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Operator
{
    /**
     * @Assert\NotBlank
     */
    public $oib;

    /**
     * @Assert\NotBlank
     */
    public $label;

    /**
     * @Assert\NotBlank
     */
    public $name;
}