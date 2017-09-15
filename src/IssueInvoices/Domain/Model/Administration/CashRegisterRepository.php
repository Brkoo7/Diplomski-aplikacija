<?php

namespace IssueInvoices\Domain\Model\Administration;

interface CashRegisterRepository
{
	/**
     * Sprema naplatni uređaj.
     *
     * @param CashRegister $cashRegister
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(CashRegister $cashRegister);

    /**
     * Briše naplatni uređaj.
     *
     * @param CashRegister $cashRegister
     *
     * @throws \Exception Ako se dogodi greška tijekom brisanja
     */
    public function remove(CashRegister $cashRegister);
}
