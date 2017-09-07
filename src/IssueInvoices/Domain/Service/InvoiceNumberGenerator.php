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
	private $securityToken;

	public function __construct($entityManager, InvoiceRepository $invoiceRepository, $securityToken)
	{
		$this->entityManager = $entityManager;
		$this->invoiceRepository = $invoiceRepository;
		$this->securityToken = $securityToken;
	}

	public function calculateOrdinalNumber(string $officeLabel, int $cashRegisterNumber): int
	{
		$userId = $this->securityToken->getToken()->getUser()->getId();

		// Traži max broj za kombinaciju u trenutnoj godini
		$ordinalNumber = $this->invoiceRepository->findMaxOrdinalNumberForCombination(
			$officeLabel, $cashRegisterNumber, $userId);
		
		// Ako postoji kombinacija i ako je godina trenutnog racuna identicna kao u bazi
		if ($ordinalNumber) {
		 	return ++$ordinalNumber;
		} else {
			return 1;
		}
	}
}
