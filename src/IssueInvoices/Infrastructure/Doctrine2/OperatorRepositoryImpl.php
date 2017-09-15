<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Operator;
use IssueInvoices\Domain\Model\Administration\OperatorRepository;

class OperatorRepositoryImpl extends EntityRepository implements OperatorRepository
{
	public function store(Operator $operator)
    {
        $this->_em->persist($operator);
        $this->_em->flush();
    }

    public function remove(Operator $operator)
    {
    	$this->_em->remove($operator);
    	$this->_em->flush();
    }
}

