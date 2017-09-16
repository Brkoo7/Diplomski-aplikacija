<?php

namespace IssueInvoices\Domain\Model\Invoice;

interface InvoiceRepository
{
	/**
     * Traži račun po identifikatoru.
     *
     * @param int $id
     *
     * @return BaseInvoice|null null ako nije pronađeno
     */
    public function find($id);

    /**
     * Traži sve račune u repozitoriju.
     *
     * @return BaseInvoice[]
     */
    public function findAll();

    /**
     * Sprema račun.
     *
     * @param BaseInvoice $invoice
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(BaseInvoice $invoice);

	/**
	 * Traži maksimalni redni broj računa za danu kombinaciju
	 * 
	 * @param string $officeLabel Oznaka poslovnog prostora
	 * @param int $cashRegisterNumber broj blagajne unutar poslovnog prostora
	 * @param int $userId identifikator korisnika
	 * 
	 * @return int|null null ako ne postoji kombinacija u bazi
	 */
	public function findMaxOrdinalNumberForCombination(
		string $officeLabel, 
		int $cashRegisterNumber, 
		int $userId, 
		\DateTimeImmutable $startDate, 
		\DateTimeImmutable $endDate
	);
}
