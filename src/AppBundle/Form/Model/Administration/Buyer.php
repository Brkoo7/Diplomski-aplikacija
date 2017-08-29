<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Buyer
{
    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
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
     * @Assert\Type(type="integer")
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Naziv artikla mora imati barem {{ limit }} znakova",
     *      maxMessage = "Naziv artikla ne može imati više od {{ limit }} znakova"
     * )
     */
    
    /**
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *     min=11,
     *     exactMessage = "OIB mora imati {{ limit }} brojeva",
     * )
     */
    public $oib;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     */
    public $pdvID;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     */
    public $address;
}