<?php

namespace IssueInvoices\Domain\Model\Administration;

interface ArticleRepository
{
	/**
	 * Pronalazi sve artikle za administraciju korisnika
	 * 
	 * @param Administration $administrationId ID administracije prijavljenog korisnika
	 * 
	 * @return Article[]
	 */
	public function findAllForUserAdministration($administration);
}
