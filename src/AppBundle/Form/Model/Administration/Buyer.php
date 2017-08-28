<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Buyer
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Ime mora imati barem {{ limit }} znakova",
     *      maxMessage = "Ime ne može imati više od {{ limit }} znakova"
     * )
     */
    public $name;

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
    public $address;
}