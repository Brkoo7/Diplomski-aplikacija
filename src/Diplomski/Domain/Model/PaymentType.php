<?php

namespace Diplomski\Domain\Model;

class PaymentType
{
    /**
     * Identifikator vrste
     *
     * @var int
     */
    private $id;

    /**
     * Podržane vrste
     */
    static private $supported = [
        1 => ['CASH', 'Gotovina'],
        2 => ['CREDIT_CARD', 'Kreditna kartica'],
        3 => ['TRANSACTION_ACCOUNT', 'Transakcijski racun'],
    ];

    /**
     * @param int $id
     *
     * @throws InvalidArgumentException Ako zadani tip identifikatora racuna nije podrzan
     */
    private function __construct(int $id)
    {
        if (!isset(self::$supported[(int) $id]))
            throw new InvalidArgumentException(sprintf('Identifikator tipa placanja: %d nije podržan', $id));
        $this->id = (int) $id;
    }

    static public function fromInteger($integer): self
    {
        return new self($integer);
    }

    public function toInteger(): int
    {
        return $this->id;
    }

    public function sameAs(self $other): bool
    {
        return $this->id == $other->id;
    }


    static public function bankNoteType(): self
    {
        return new self(1);
    }

    static public function cardType(): self
    {
        return new self(2);
    }

    static public function checkType(): self
    {
        return new self(3);
    }

    static public function transactionAccountType(): self
    {
        return new self(4);
    }

    public function isBankNotes(): bool
    {
        return $this->id == 1;
    }

    public function isCard(): bool
    {
        return $this->id == 2;
    }

    public function isCheck(): bool
    {
        return $this->id == 3;
    }

    public function isTransactionAccount(): bool
    {
        return $this->id == 4;
    }

    public function title(): string
    {
        return self::$supported[$this->id][0];
    }
}