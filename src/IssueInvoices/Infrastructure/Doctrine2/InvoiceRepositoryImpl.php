<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use Doctrine\ORM\EntityRepository;

class InvoiceRepositoryImpl extends EntityRepository implements InvoiceRepository
{
	
}

