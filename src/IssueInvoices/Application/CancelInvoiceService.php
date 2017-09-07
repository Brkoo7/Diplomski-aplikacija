<?php
namespace IssueInvoices\Application;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use IssueInvoices\Domain\Model\Invoice\InvoiceFactory;
use IssueInvoices\Domain\Model\Invoice\CancelInvoiceException;
use InvalidArgumentException;

/**
 * Aplikacijski servis - USE CASE - storniraj mi taj i taj račun
 */
class CancelInvoiceService
{
	private $entityManager;
	private $invoiceRepository;
	private $invoiceFactory;

	public function __construct(
		$entityManager, 
		InvoiceRepository $invoiceRepository,
		InvoiceFactory $invoiceFactory
	)
	{
		$this->entityManager = $entityManager;
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
		$this->entityManager->persist($cancelInvoice);
		$this->entityManager->persist($invoice);
		$this->entityManager->flush();
	}
}
