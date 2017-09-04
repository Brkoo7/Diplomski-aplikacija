<?php
namespace AppBundle\Form\Model\Invoice;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;

class Invoice
{
    public $buyer;

    public $operator;

    public $office;

    public $articles = [];

    public $cashRegister;

    public $paymentType;

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    public function removeArticle(Article $article)
    {
        $key = array_search($article, $this->articles);
        if($key !== false) {
            unset($this->articles[$key]);
        }
    }

    public function __construct()
    {
    }
}