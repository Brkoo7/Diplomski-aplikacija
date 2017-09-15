<?php
namespace IssueInvoices\Domain\Model\User;

interface UserRepository
{
	/**
     * Sprema korisnika.
     *
     * @param User $user
     *
     * @throws \Exception Ako se dogodi greška prilikom spremanja
     */
    public function store(User $user);
}
