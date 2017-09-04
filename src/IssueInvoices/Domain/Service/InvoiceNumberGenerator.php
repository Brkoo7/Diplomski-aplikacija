<?php
namespace IssueInvoices\Domain\Service;

/**
 * Domenski servis generiranja broja računa
 */
class InvoiceNumberGenerator
{
	private $entityManager;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function generateNumber($data)
	{

	}
