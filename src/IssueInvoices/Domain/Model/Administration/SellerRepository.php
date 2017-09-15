<?php

namespace IssueInvoices\Domain\Model\Administration;

interface SellerRepository
{
	/**
     * Sprema prodavatelja.
     *
     * @param Seller $seller
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Seller $seller);
}
