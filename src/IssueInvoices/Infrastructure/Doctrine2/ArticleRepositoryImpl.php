<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\ArticleRepository;
use Doctrine\ORM\EntityRepository;

class ArticleRepositoryImpl extends EntityRepository implements ArticleRepository
{
	public function findAllForUserAdministration($administrationId) 
	{
		$dql = 'SELECT a, ad FROM IssueInvoices\Domain\Model\Administration\Article AS a JOIN a.administration AS ad WHERE ad.id = :id';

		return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameter('id', $administrationId)
            ->getResult();
	}
}

