<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Seller
{
    /**
     * @Assert\NotBlank
     */
    public $companyName;

    /**
     * @Assert\NotBlank
     */
    public $personName;

    /**
     * @Assert\NotBlank
     */
    public $oib;

    /**
     * @Assert\NotBlank
     */
    public $pdvID;

    /**
     * @Assert\NotBlank
     */
    public $phoneNumber;

    /**
     * @Assert\NotBlank
     */
    public $email;

    /**
     * @Assert\NotBlank
     */
    public $street;

    /**
     * @Assert\NotBlank
     */
    public $postalCode;

    /**
     * @Assert\NotBlank
     */
    public $city;

    /**
     * @Assert\NotBlank
     */
    public $countryCode;

    /**
     * @Assert\NotBlank
     */
    public $inVATSystem;
}