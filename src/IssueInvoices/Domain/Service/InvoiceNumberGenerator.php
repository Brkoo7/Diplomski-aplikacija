<?php
namespace IssueInvoices\Domain\Service;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;

/**
 * Domenski servis generiranja broja računa
 */
class InvoiceNumberGenerator
{
	private $entityManager;
	private $invoiceRepository;

	public function __construct($entityManager, InvoiceRepository $invoiceRepository)
	{
		$this->entityManager = $entityManager;
		$this->invoiceRepository = $invoiceRepository;
	}

	public function calculateOrdinalNumber(string $officeLabel, int $cashRegisterNumber): int
	{
		return 1;
		// Pronaci max. redni broj za kombinaciju office, cashRegister
		$ordinalNumber = $this->invoiceRepository->findMaxOrdinalNumberForCombination(
			$officeLabel, $cashRegisterNumber);
		// Ako postoji kombinacija i ako nismo presli u novu godinu
		if ($ordinalNumber) {
			return ++$ordinalNumber;
		} else {
			return 1;
		}
	}
}
