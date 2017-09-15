<?php

namespace IssueInvoices\Domain\Model\Administration;

interface OperatorRepository
{
	/**
     * Sprema operatera naplatnog uređaja.
     *
     * @param Operator $operator
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(Operator $operator);

    /**
     * Briše operatera naplatnog uređaja.
     *
     * @param Operator $operator
     *
     * @throws \Exception Ako se dogodi greška tijekom brisanja
     */
    public function remove(Operator $operator);
}
