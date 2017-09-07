<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use Doctrine\ORM\EntityRepository;

class InvoiceRepositoryImpl extends EntityRepository implements InvoiceRepository
{
	public function findMaxOrdinalNumberForCombination(string $officeLabel, int $cashRegisterNumber, int $userId)
	{
        // Odabrati sve racune trazenog korisnika te brojeve tih racuna
		$dql = 'SELECT MAX(n.ordinal) FROM IssueInvoices\Domain\Model\Invoice\Invoice AS i JOIN i.number AS n WHERE i.user = :userId AND n.office = :officeLabel AND n.cashRegister =:cashRegisterNumber';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters([
            	'userId' => $userId,
            	'officeLabel' => $officeLabel,
            	'cashRegisterNumber' => $cashRegisterNumber
            ])
            ->getSingleScalarResult();
	}
}

