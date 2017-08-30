<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

/**
 * @todo  mora postojati ili oib ili pdvid
 */
class Buyer
{
    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Ime mora imati barem {{ limit }} znakova",
     *      maxMessage = "Ime ne može imati više od {{ limit }} znakova"
     * )
     */
    public $name;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     */
    public $address;
    
    /**
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *     min=11,
     *     max=15
     * )
     */
    public $oib;

    /**
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *     min=11,
     *     max=15
     * )
     */
    public $pdvID;
}