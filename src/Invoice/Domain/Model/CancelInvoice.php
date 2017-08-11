<?php

namespace Invoice\Domain\Model;

/**
 * Stornirani račun
 */

class CancelInvoice extends Invoice
{
    /**
     * Povezani račun iz kojeg je nastao storno račun
     *
     * @var BaseInvoice
     * @ORM\OneToOne(targetEntity="BaseInvoice")
     */
    private $relatedInvoice;
}