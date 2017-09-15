<?php
namespace IssueInvoices\Domain\Service;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;

/**
 * Domenski servis generiranja broja računa
 */
class InvoiceNumberGenerator
{
	private $invoiceRepository;
	private $securityToken;

	public function __construct(InvoiceRepository $invoiceRepository, $securityToken)
	{
		$this->invoiceRepository = $invoiceRepository;
		$this->securityToken = $securityToken;
	}

	public function calculateOrdinalNumber(string $officeLabel, int $cashRegisterNumber): int
	{
		$userId = $this->securityToken->getToken()->getUser()->getId();
		$currentYear = (int) (new \DateTimeImmutable)->format("Y");

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
