<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\OfficeRepository;
use Doctrine\ORM\EntityRepository;

class OfficeRepositoryImpl extends EntityRepository implements OfficeRepository
{
	public function findAllForUserAdministration($administrationId) 
	{
		$dql = 'SELECT a, o FROM IssueInvoices\Domain\Model\Administration\Office AS o JOIN o.administration AS a WHERE a.id = :id';

		return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $administrationId)
            ->getResult();
	}
}

