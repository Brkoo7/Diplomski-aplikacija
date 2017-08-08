<?php

namespace Diplomski\Domain\Model;

interface InvoiceRepository
{
    /**
     * Sprema novi račun
     */
    public function storeNewInvoice(Invoice $invoice);

    /**
     * Dohvaća sve izdane račune
     *
     * @return Invoice[]
     */
    public function getAllInvoices();

    /**
     * Dohvaća pojedinačni račun
     */
    public function getInvoice(int $id);
}
