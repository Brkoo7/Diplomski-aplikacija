<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\OperatorRepository;
use Doctrine\ORM\EntityRepository;

class OperatorRepositoryImpl extends EntityRepository implements OperatorRepository
{
	public function findAllForUserAdministration($administrationId) 
	{
		$dql = 'SELECT a, o FROM IssueInvoices\Domain\Model\Administration\Operator AS o JOIN o.administration AS a WHERE a.id = :id';

		return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $administrationId)
            ->getResult();
	}
}

