<?php

namespace IssueInvoices\Domain\Model\Administration;

use IssueInvoices\Domain\Model\Administration\Seller;

class SellerFactory
{
    public function fromData($sellerData)
    {
        $seller = new Seller();
        $seller->setCompanyName($sellerData->companyName);
        $seller->setPersonName($sellerData->personName);
        $seller->setOib($sellerData->oib);
        $seller->setPdvID($sellerData->pdvID);
        $seller->setPhoneNumber($sellerData->phoneNumber);
        $seller->setEmail($sellerData->email);
        $seller->setStreet($sellerData->street);
        $seller->setPostalCode($sellerData->postalCode);
        $seller->setCountryCode($sellerData->countryCode);
        $seller->setInVatSystem($sellerData->inVatSystem);

        return $seller;
    }
   
}