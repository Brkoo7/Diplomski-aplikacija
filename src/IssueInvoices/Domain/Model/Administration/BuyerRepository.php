<?php

namespace IssueInvoices\Domain\Model\Administration;

interface BuyerRepository
{
	/**
	 * Pronalazi sve kupce za administraciju korisnika
	 * 
	 * @param Administration $administrationId ID administracije prijavljenog korisnika
	 * 
	 * @return Buyer[]
	 */
	public function findAllForUserAdministration($administrationId);
}
