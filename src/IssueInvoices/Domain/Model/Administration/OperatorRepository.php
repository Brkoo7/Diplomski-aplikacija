<?php

namespace IssueInvoices\Domain\Model\Administration;

interface OperatorRepository
{
	/**
	 * Pronalazi sve kupce za administraciju korisnika
	 * 
	 * @param Administration $administrationId ID administracije prijavljenog korisnika
	 * 
	 * @return Operator[]
	 */
	public function findAllForUserAdministration($administrationId);
}
