<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;

class CashRegisterRepositoryImpl extends EntityRepository
{
	public function findForOffice(int $officeId)
	{
        $dql = 'SELECT c FROM IssueInvoices\Domain\Model\Administration\CashRegister AS c WHERE c.office = :officeId';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('officeId', $officeId)
            ->getResult();
    }
}

