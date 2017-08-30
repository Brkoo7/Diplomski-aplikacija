<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class CashRegister
{
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

    /**
     * @Assert\NotBlank
     */
    public $office;
}