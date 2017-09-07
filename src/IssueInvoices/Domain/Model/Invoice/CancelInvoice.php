<?php

namespace IssueInvoices\Domain\Model\Invoice;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CancelInvoice extends VATInvoice
{
    /**
     * Povezani račun iz kojeg je nastao storno račun
     *
     * @var BaseInvoice
     * @ORM\OneToOne(targetEntity="BaseInvoice")
     */
    private $relatedInvoice;

    public function setRelatedInvoice(BaseInvoice $invoice)
    {
    	$this->relatedInvoice = $invoice;
    }

    public function getRelatedInvoice(): BaseInvoice
    {
        return $this->relatedInvoice;
    }
}