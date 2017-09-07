<?php

namespace IssueInvoices\Domain\Model\Invoice;

use RuntimeException;

class CancelInvoiceException extends RuntimeException
{
    public static function invoiceAlreadyCancelled(): self
    {
        return new self(
            sprintf('Račun je već storniran, nije ga moguće više stornirati'));
    }

    public static function invoiceIsCancel(): self
    {
        return new self(
            sprintf('Radi se o storno računu te ga nije moguće stornirati'));
    }
}
