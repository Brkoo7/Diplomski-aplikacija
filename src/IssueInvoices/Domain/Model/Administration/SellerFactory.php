<?php

namespace IssueInvoices\Domain\Model\Administration;

use IssueInvoices\Domain\Model\Administration\Seller;

class SellerFactory
{
    public function fromData($sellerData)
    {
        $seller = new Seller();
        $seller = $this->createFromData($sellerData, $seller);

        return $seller;
    }

    public function fromDataAndObject($sellerData, $seller)
    {
        $seller = $this->createFromData($sellerData, $seller);

        return $seller;
    }

    private function createFromData($sellerData, $seller)
    {
        $seller->setCompanyName($sellerData->companyName);
        $seller->setPersonName($sellerData->personName);
        $seller->setOib($sellerData->oib);
        $seller->setPdvID($sellerData->pdvID);
        $seller->setPhoneNumber($sellerData->phoneNumber);
        $seller->setEmail($sellerData->email);
        $seller->setStreet($sellerData->street);
        $seller->setPostalCode($sellerData->postalCode);
        $seller->setCountry($sellerData->country);
        $seller->setCity($sellerData->city);
        $seller->setInVatSystem($sellerData->inVATSystem);

        return $seller;
    }
   
}