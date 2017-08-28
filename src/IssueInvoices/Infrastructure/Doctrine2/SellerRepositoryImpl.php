<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\SellerRepository;
use Doctrine\ORM\EntityRepository;

class SellerRepositoryImpl extends EntityRepository implements SellerRepository
{
	public function findSellerForUserAdministration($administrationId) 
	{
		$dql = 'SELECT s, ad FROM IssueInvoices\Domain\Model\Administration\Seller AS s JOIN s.administration AS ad WHERE ad.id = :id';

		return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $administrationId)
            ->getOneOrNullResult();
	}
}

