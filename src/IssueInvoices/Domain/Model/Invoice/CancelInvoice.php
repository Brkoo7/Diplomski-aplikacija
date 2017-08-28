<?php

namespace IssueInvoices\Domain\Model\Invoice;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CancelInvoice extends BaseInvoice
{
    /**
     * Povezani račun iz kojeg je nastao storno račun
     *
     * @var BaseInvoice
     * @ORM\OneToOne(targetEntity="BaseInvoice")
     */
    private $relatedInvoice;
}