<?php

namespace IssueInvoices\Domain\Model\Administration;

interface BuyerRepository
{
	/**
     * Sprema kupca.
     *
     * @param Buyer $buyer
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Buyer $buyer);

    /**
     * Briše kupca.
     *
     * @param Buyer $buyer
     *
     * @throws \Exception Ako se dogodi greška tijekom brisanja
     */
    public function remove(Buyer $buyer);
}
