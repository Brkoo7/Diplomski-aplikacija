<?php

namespace IssueInvoices\Domain\Model\Administration;

interface SellerRepository
{
	/**
	 * @param $administrationId $administrationId
	 *
	 * @throws Exception Ako postoji više od jednog prodavatelja
	 * 
	 * @return Seller
	 */
	public function findSellerForUserAdministration($administrationId);
}
