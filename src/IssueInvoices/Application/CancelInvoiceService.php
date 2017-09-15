<?php
namespace IssueInvoices\Application;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use IssueInvoices\Domain\Model\Invoice\InvoiceFactory;
use IssueInvoices\Domain\Model\Invoice\CancelInvoiceException;
use InvalidArgumentException;

/**
 * Aplikacijski servis - USE CASE - storniraj mi taj i taj račun
 * maknuti entitymanager
 */
class CancelInvoiceService
{
	private $invoiceRepository;
	private $invoiceFactory;

	public function __construct( 
		InvoiceRepository $invoiceRepository,
		InvoiceFactory $invoiceFactory
	)
	{
		$this->invoiceRepository = $invoiceRepository;
		$this->invoiceFactory = $invoiceFactory;
	}
	
	/**
	 * Stvara storno račun originalnog računa
	 *
	 * @param int $invoiceId - identifikator originalnog racuna kojeg treba stornirati
	 *
	 * @throws CancelInvoiceException ako se probaju stornirati već stornirani racuni ili storno racuni
	 * @throws InvalidArgumentException ako račun nije pronađen u bazi
	 */
	public function cancelInvoice(int $invoiceId)
	{
		$invoice = $this->invoiceRepository->find($invoiceId);

		if (!$invoice) {
			throw new InvalidArgumentException(sprintf('Račun "%s" nije pronađen', $invoiceId));
		}
		if ($invoice->isCancelled()) {
			throw CancelInvoiceException::invoiceAlreadyCancelled();
		}
		if ($invoice->isCancel()) {
			throw CancelInvoiceException::invoiceIsCancel();
		}

		$invoice->cancel();
		$cancelInvoice = $this->invoiceFactory->createCancelFromOriginalInvoice($invoice);
		$this->invoiceRepository->store($cancelInvoice);
		$this->invoiceRepository->store($invoice);
	}
}
