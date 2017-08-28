<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Office
{
	/**
     * @Assert\NotBlank
     */
    public $label;

    /**
     * @Assert\NotBlank
     */
    public $address;
}