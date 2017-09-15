<?php

namespace IssueInvoices\Infrastructure\Doctrine2;

use IssueInvoices\Domain\Model\User\UserRepository;
use IssueInvoices\Domain\Model\User\User;
use Doctrine\ORM\EntityRepository;

class UserRepositoryImpl extends EntityRepository implements UserRepository
{
	public function store(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}

