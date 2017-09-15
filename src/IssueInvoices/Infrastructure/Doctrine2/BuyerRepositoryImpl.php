<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Buyer;
use IssueInvoices\Domain\Model\Administration\BuyerRepository;

class BuyerRepositoryImpl extends EntityRepository implements BuyerRepository
{
	public function store(Buyer $buyer)
    {
        $this->_em->persist($buyer);
        $this->_em->flush();
    }

    public function remove(Buyer $buyer)
    {
    	$this->_em->remove($buyer);
    	$this->_em->flush();
    }
}

