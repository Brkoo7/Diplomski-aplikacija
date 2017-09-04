<?php
namespace IssueInvoices\Domain\Service;

use IssueInvoices\Domain\Model\BaseInvoice;
use IssueInvoices\Domain\Model\CancelInvoice;

/**
 * Domenski servis stvaranja storno računa - sadrži poslovnu logiku kreiranja
 */
class CancelInvoiceService
{
	/**
	 * Stvara storno račun originalnog računa
	 */
	public function cancelInvoice(BaseInvoice $invoice): CancelInvoice
	{
		
	}
