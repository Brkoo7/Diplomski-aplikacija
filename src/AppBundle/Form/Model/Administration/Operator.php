<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Operator
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
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *     min=11,
     *     max=15
     * )
     */
    public $oib;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 5,
     *      minMessage = "Oznaka mora imati barem {{ limit }} znak",
     *      maxMessage = "Oznaka ne može imati više od {{ limit }} znakova"
     * )
     */
    public $label;
}