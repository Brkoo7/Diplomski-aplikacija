<?php
namespace IssueInvoices\Infrastructure\Doctrine2;

use Doctrine\ORM\EntityRepository;
use IssueInvoices\Domain\Model\Administration\Seller;
use IssueInvoices\Domain\Model\Administration\SellerRepository;

class SellerRepositoryImpl extends EntityRepository implements SellerRepository
{
	public function store(Seller $seller)
    {
        $this->_em->persist($seller);
        $this->_em->flush();
    }
}

