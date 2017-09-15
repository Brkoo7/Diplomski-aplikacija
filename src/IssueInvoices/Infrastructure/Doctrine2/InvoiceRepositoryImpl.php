<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Invoice\InvoiceRepository;
use IssueInvoices\Domain\Model\Invoice\BaseInvoice;
use Doctrine\ORM\EntityRepository;

class InvoiceRepositoryImpl extends EntityRepository implements InvoiceRepository
{
    public function store(BaseInvoice $invoice)
    {
        $this->_em->persist($invoice);
        $this->_em->flush();
    }

    public function findMaxOrdinalNumberForCombination(string $officeLabel, int $cashRegisterNumber, int $userId, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate)
    {
        // Odabrati sve racune trazenog korisnika te brojeve tih racuna
        $dql = 'SELECT MAX(n.ordinal) FROM IssueInvoices\Domain\Model\Invoice\Invoice AS i JOIN i.number AS n WHERE i.user = :userId AND (i.issueDate BETWEEN :startDate AND :endDate) AND n.office = :officeLabel AND n.cashRegister =:cashRegisterNumber';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters([
                'userId' => $userId,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'officeLabel' => $officeLabel,
                'cashRegisterNumber' => $cashRegisterNumber
            ])
            ->getSingleScalarResult();
    }
}

