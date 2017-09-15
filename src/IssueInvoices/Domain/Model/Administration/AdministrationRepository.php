<?php

namespace IssueInvoices\Domain\Model\Administration;

interface AdministrationRepository
{
	/**
     * Sprema administraciju.
     *
     * @param Administration $administration
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Administration $administration);
}