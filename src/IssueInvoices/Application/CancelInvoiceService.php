<?php
namespace IssueInvoices\Application;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use IssueInvoices\Domain\Service\CancelInvoiceService as CancelInvoiceDomainService;

/**
 * Aplikacijski servis - USE CASE - storniraj mi taj i taj račun
 */
class CancelInvoiceService
{
	private $entityManager;
	private $invoiceRepository;
	private $cancelInvoiceService;

	public function __construct(
		$entityManager, 
		InvoiceRepository $invoiceRepository,
		CancelInvoiceDomainService $cancelInvoiceService
	)
	{
		$this->entityManager = $entityManager;
		$this->invoiceRepository = $invoiceRepository;
		$this->cancelInvoiceService = $cancelInvoiceService;
	}

	/**
	 * Stvara storno račun originalnog računa
	 *
	 * @param int $invoiceId - identifikator originalnog racuna kojeg treba stornirati
	 *
	 * @throws Exception ako dođe do greške tijekom spremanja
	 */
	public function cancelInvoice(int $invoiceId)
	{
		// Pronalazi orig. racun po id-u
		// $invoice = findById($invoiceId)
		// Poziva domenski servis koji sadrži poslovnu logiku kreiranja storno racuna
		// $cancelInvoice = $this->cancelInvoiceService($invoice);
		// Sprema storno racun
	}
}
