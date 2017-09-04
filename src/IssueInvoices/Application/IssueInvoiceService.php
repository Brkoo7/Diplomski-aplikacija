<?php
namespace IssueInvoices\Application;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use IssueInvoices\Domain\Model\Invoice\InvoiceFactory;

/**
 * Aplikacijski servis izdavanja racuna
 */
class IssueInvoiceService
{
	private $entityManager;
	private $invoiceRepository;

	public function __construct($entityManager, InvoiceRepository $invoiceRepository)
	{
		$this->entityManager = $entityManager;
		$this->invoiceRepository = $invoiceRepository;
	}

	/**
	 * Poziva factory i brine se za spremanje racuna
	 * 
	 * @param $formInvoice
	 * @param $administration
	 *
	 * @throws Exception u slučaju pogreške tijekom spremanja
	 */
	public function issueInvoice($formInvoice, $administration)
	{
		$invoice = InvoiceFactory::createFromData($formInvoice, $administration);
		// Poziv factory-a s parametrom $formInvoice
		// $invoice = InvoiceFactory($formInvoice);
		// Spremi invoice
	}
}
