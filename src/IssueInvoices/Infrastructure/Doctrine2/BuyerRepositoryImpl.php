<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\BuyerRepository;
use Doctrine\ORM\EntityRepository;

class BuyerRepositoryImpl extends EntityRepository implements BuyerRepository
{
	public function findAllForUserAdministration($administrationId) 
	{
		$dql = 'SELECT a, b FROM IssueInvoices\Domain\Model\Administration\Buyer AS b JOIN b.administration AS a WHERE a.id = :id';

		return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $administrationId)
            ->getResult();
	}
}

