<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\CashRegister;
use IssueInvoices\Domain\Model\Administration\CashRegisterRepository;

class CashRegisterRepositoryImpl extends EntityRepository implements CashRegisterRepository
{
	public function store(CashRegister $cashRegister)
    {
        $this->_em->persist($cashRegister);
        $this->_em->flush();
    }

    public function remove(CashRegister $cashRegister)
    {
    	$this->_em->remove($cashRegister);
    	$this->_em->flush();
    }

	public function findForOffice(int $officeId)
	{
        $dql = 'SELECT c FROM IssueInvoices\Domain\Model\Administration\CashRegister AS c WHERE c.office = :officeId';

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('officeId', $officeId)
            ->getResult();
    }
}

