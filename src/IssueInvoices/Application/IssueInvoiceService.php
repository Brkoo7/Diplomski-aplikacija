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
	private $invoiceFactory;

	public function __construct($entityManager, InvoiceRepository $invoiceRepository, InvoiceFactory $invoiceFactory)
	{
		$this->entityManager = $entityManager;
		$this->invoiceRepository = $invoiceRepository;
		$this->invoiceFactory = $invoiceFactory;
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
		$invoice = $this->invoiceFactory->createFromData($formInvoice, $administration);

		$this->entityManager->persist($invoice);
		$this->entityManager->flush();
	}
}
