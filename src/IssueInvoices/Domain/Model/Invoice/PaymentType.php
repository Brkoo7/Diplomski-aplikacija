<?php

namespace IssueInvoices\Domain\Model\Invoice;
    
/**
 * Načini plačanja računa
 */
class PaymentType
{
    /**
     * Naziv trenutačne opcije
     *
     * @var string
     */
    private $name;

    /**
     * @param string $name Naziv opcije
     * 
     * @throws InvalidArgumentException Ako zadana opcije nije ispravna
     */
    public function __construct($name)
    {
        
        $this->name = (string) $name;
    }

    public function __toString()
    {
        return $this->name();
    }

    /**
     * Dohvaća naziv
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Dohvaća naslov
     */
    public function titleName()
    {
        return self::names()[$this->name];
    }

    /**
     * Je li trenutačna opcija jednaka zadanoj
     *
     * @param self|string $other Opcija ili naziv opcije (ako nije opcija, vrši se pretvaranje u string)
     * @return bool
     */
    public function equals($other)
    {
        $otherName = $other instanceof static ? $other->name : (string)$other;
        return $this->name == $otherName;
    }

    /**
     * Provjerava radi li se o gotovini.
     *
     * @return bool
     */
    public function isCash()
    {
        return $this->equals('CASH');
    }

    /**
     * Provjerava radi li se o kartici.
     *
     * @return bool
     */
    public function isCreditCard()
    {
        return $this->equals('CREDIT_CARD');
    }

    /**
     * Provjerava radi li se o transakcijskom računu.
     *
     * @return bool
     */
    public function isTransactionAccount()
    {
        return $this->equals('TRANSACTION_ACCOUNT');
    }

    /**
     * Provjerava radi li se o ostalim načinima plaćanja.
     *
     * @return bool
     */
    public function isOther()
    {
        return $this->equals('OTHER');
    }

    public static function names()
    {
        return [
            'CASH' => 'Gotovina',
            'CREDIT_CARD' => 'Kreditna kartica',
            'TRANSACTION_ACCOUNT' => 'Transakcijski račun',
            'OTHER' => 'Ostalo'
        ];
    }
}
