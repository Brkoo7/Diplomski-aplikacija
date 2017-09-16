<?php
namespace IssueInvoices\Domain\Service;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;

/**
 * Domenski servis generiranja broja računa
 */
class InvoiceNumberGenerator
{
	private $invoiceRepository;

	public function __construct(InvoiceRepository $invoiceRepository)
	{
		$this->invoiceRepository = $invoiceRepository;
	}

	public function calculateOrdinalNumber(
		string $officeLabel, 
		int $cashRegisterNumber, 
		int $userId
	): int {
		$startDate = (new \DateTimeImmutable('first day of January this year'))->setTime(0, 0, 0);
		$endDate = (new \DateTimeImmutable('last day of December this year'))->setTime(0, 0, 0);

		$ordinalNumber = $this->invoiceRepository->findMaxOrdinalNumberForCombination(
			$officeLabel, 
			$cashRegisterNumber, 
			$userId,
			$startDate,
			$endDate
		);

		if ($ordinalNumber) {
		 	return ++$ordinalNumber;
		} else {
			return 1;
		}
	}
}
