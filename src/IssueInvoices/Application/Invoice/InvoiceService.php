<?php

namespace IssueInvoices\Application\Service;

/**
 * Aplikacijski servis za racune
 *
 * It’s important to note that an AS doesn’t have any business behaviour. It knows only what model to use but not how that model works. So, the AS knows which Aggregate to invoke, it knows about some Domain Services that might be required, but that’s it.
 */
interface InvoiceService
{
    /**
     * Fiskaliziraj račun
     */
    public function fiscalInvoice($invoice);

    /**
     * Storniraj račun
     */
    public function cancelInvoice($invoice);
}
