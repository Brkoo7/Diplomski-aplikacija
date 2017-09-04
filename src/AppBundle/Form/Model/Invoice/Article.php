<?php
namespace AppBundle\Form\Model\Invoice;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Article
{
	/**
     * @Assert\NotBlank
     */
	public $article;

    public $totalPrice;

    public $taxRate;

	/**
     * @Assert\NotBlank
     * @Assert\Type(type="int")
     */
    public $quantity;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="float")
     */
    public $discount;

    public function __construct()
    {
        $this->quantity = 1;
    }
}