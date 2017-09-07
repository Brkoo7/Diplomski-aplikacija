<?php

namespace AppBundle\Twig;

use IssueInvoices\Domain\Model\Invoice\VATInvoice;
use IssueInvoices\Domain\Model\Invoice\CancelInvoice;

class InvoiceStatusExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('invoiceStatus', [$this, 'getInvoiceStatus']),
            new \Twig_SimpleFunction('isDisabled', [$this, 'isDisabled']),
            new \Twig_SimpleFunction('hasInvoiceVAT', [$this, 'hasInvoiceVAT'])
        ];
    }

    public function getInvoiceStatus($object): string
    {
        if ($object->isCancelled()) {
            return 'STORNIRAN';
        } elseif ($object->isCancel()) {
            return 'STORNO';
        } else {
            return 'IZDAN';
        }
    }

    public function hasInvoiceVAT($object): bool
    {
        if (($object instanceOf VATInvoice && !($object instanceOf CancelInvoice)) || ($object instanceOf CancelInvoice && ($object->getRelatedInvoice()) instanceOf VATInvoice)) {
            return true;
        } else {
            return false;
        }
    }

    public function isDisabled($invoice)
    {
        if ($invoice->isCancelled() || $invoice->isCancel()) {
            return 'disabled=disabled';
        }
    }

    public function getName()
    {
        return 'invoice_status_extension';
    }
}
