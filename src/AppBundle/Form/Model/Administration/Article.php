<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Article
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Naziv artikla mora imati barem {{ limit }} znakova",
     *      maxMessage = "Naziv artikla ne može imati više od {{ limit }} znakova"
     * )
     */
    public $name;

    /**
     * @Assert\NotBlank
     */
    public $totalPrice;

    /**
     * @Assert\NotBlank
     */
    public $taxRate;
}