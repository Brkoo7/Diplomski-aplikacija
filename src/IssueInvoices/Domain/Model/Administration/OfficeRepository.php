<?php

namespace IssueInvoices\Domain\Model\Administration;

interface OfficeRepository
{
	/**
     * Sprema poslovni prostor.
     *
     * @param Office $office
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Office $office);

    /**
     * Briše poslovni prostor.
     *
     * @param Office $office
     *
     * @throws \Exception Ako se dogodi greška tijekom brisanja
     */
    public function remove(Office $office);
}
