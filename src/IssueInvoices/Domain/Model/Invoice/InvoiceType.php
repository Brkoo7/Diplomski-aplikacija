<?php

namespace IssueInvoices\Domain\Model\Invoice;

class InvoiceType
{
    /**
     * Identifikator vrste
     *
     * @var int
     */
    private $id;

    /**
     * Podržane vrste racuna
     */
    static private $supported = [
    ];

    /**
     * @param int $id
     *
     * @throws InvalidArgumentException Ako zadani tip identifikatora racuna nije podrzan
     */
    private function __construct(int $id)
    {
        if (!isset(self::$supported[(int) $id]))
            throw new InvalidArgumentException(sprintf('Identifikator tipa racuna: %d nije podržan', $id));
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

    static public function advanceType(): self
    {
        return new self(1);
    }

    static public function serviceType(): self
    {
        return new self(2);
    }

    static public function checkType(): self
    {
        return new self(3);
    }

    public function title(): string
    {
        return self::$supported[$this->id][0];
    }
}