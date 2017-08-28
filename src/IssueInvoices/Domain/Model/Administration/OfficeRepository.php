<?php

namespace IssueInvoices\Domain\Model\Administration;

interface OfficeRepository
{
	/**
	 * Pronalazi sve kupce za administraciju korisnika
	 * 
	 * @param Administration $administrationId ID administracije prijavljenog korisnika
	 * 
	 * @return Office[]
	 */
	public function findAllForUserAdministration($administrationId);
}
