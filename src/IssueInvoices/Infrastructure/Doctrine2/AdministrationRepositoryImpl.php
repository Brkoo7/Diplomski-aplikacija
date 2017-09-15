<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Administration;
use IssueInvoices\Domain\Model\Administration\AdministrationRepository;

class AdministrationRepositoryImpl extends EntityRepository implements AdministrationRepository
{
	public function store(Administration $administration)
    {
        $this->_em->persist($administration);
        $this->_em->flush();
    }
}
