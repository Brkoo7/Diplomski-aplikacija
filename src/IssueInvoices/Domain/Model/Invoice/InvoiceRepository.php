<?php
namespace IssueInvoices\Domain\Model\Invoice;

interface InvoiceRepository
{
	/**
	 * Traži maksimalni redni broj računa za danu kombinaciju
	 * 
	 * @param  string $officeLabel        Oznaka poslovnog prostora
	 * @param  int    $cashRegisterNumber broj blagajne unutar poslovnog prostora
	 * @param  int    $userId identifikator korisnika
	 * 
	 * @return int|null null ako ne postoji kombinacija u bazi
	 */
	public function findMaxOrdinalNumberForCombination(string $officeLabel, int $cashRegisterNumber, int $userId);
}
