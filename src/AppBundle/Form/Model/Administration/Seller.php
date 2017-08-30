<?php
namespace AppBundle\Form\Model\Administration;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Seller
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Naziv tvrtke mora imati barem {{ limit }} znakova",
     *      maxMessage = "Naziv tvrtke ne može imati više od {{ limit }} znakova"
     * )
     */
    public $companyName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Naziv osobe mora imati barem {{ limit }} znakova",
     *      maxMessage = "Naziv osobe ne može imati više od {{ limit }} znakova"
     * )
     */
    public $personName;

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
     * @Assert\Type(type="string")
     * @Assert\Length(
     *     min=11,
     *     max=15
     * )
     */
    public $pdvID;

    /**
     * @Assert\Type(type="string")
     * @Assert\Length(
     *     max=15
     * )
     */
    public $phoneNumber;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    public $email;

    /**
     * @Assert\NotBlank
     */
    public $street;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="numeric")
     * @Assert\Length(
     *     max=10
     * )
     */
    public $postalCode;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     */
    public $city;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Length(
     *     max=30
     * )
     */
    public $country;

    public $inVATSystem;
}