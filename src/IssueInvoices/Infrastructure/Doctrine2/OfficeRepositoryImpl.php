<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Office;
use IssueInvoices\Domain\Model\Administration\OfficeRepository;

class OfficeRepositoryImpl extends EntityRepository implements OfficeRepository
{
	public function store(Office $office)
    {
        $this->_em->persist($office);
        $this->_em->flush();
    }

    public function remove(Office $office)
    {
    	$this->_em->remove($office);
    	$this->_em->flush();
    }
}

