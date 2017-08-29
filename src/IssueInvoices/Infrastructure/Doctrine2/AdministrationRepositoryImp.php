<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\Administration\AdministrationRepository;
use Doctrine\ORM\EntityRepository;

class AdministrationRepositoryImpl extends EntityRepository implements AdministrationRepository
{
	
}

