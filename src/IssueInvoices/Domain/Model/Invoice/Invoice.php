<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Fiskalni račun bez PDV-a
 * 
 * Obveznici fizkalizacije:
 * + fizičke osobe obveznici poreza na dohodak po osnovi samostalne djelatnosti prema odredbama Zakona o porezu na dohodak (obveznici vođenja poslovnih knjiga i „paušalisti“)
   + pravna i fizička osoba koja se smatra obveznikom poreza na dobit prema Zakonu o porezu na dobit za sve djelatnosti za koje je, prema odredbama posebnih propisa, obveznik izdavanja računa za isporuku dobra ili obavljene usluge.
   + Prema tome, novost je da su obveznici fiskalizacije (izdavanja fiskaliziranih računa) i samostalne djelatnosti, obveznici poreza na dohodak, kojima se ostvareni dohodak paušalno oporezuje.
   - iznajmljivači soba i postelja putnicima i turistima te organizatori kampova kojima se tako ostvareni dohodak paušalno oporezuje, nisu obveznici fiskalizacije jer ne obavljaju samostalnu djelatnost u smislu odredbi Zakona o porezu na dohodak  već ostvaruju dohodak od imovine.
 *
 * @ORM\Entity
 */
class Invoice extends BaseInvoice
{
    /**
     * Oznaka operatera
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    protected $operatorLabel;

    /**
     * Ime i prezime operatera
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $operatorName;

    /**
     * OIB operatera
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $operatorOIB;

    /**
     * Tip placanja (gotovina, transakcijski račun)
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    protected $paymentType;

    /**
     * Broj računa.
     *
     * @var Number
     * @ORM\OneToOne(targetEntity="InvoiceNumber", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $number;

    /**
     * Zaštitni kod izdavatelja računa.
     *
     * @var string|null
     * @ORM\Column(name="zki_code", type="string", nullable=true)
     */
    protected $ZKICode;

    /**
     * Jedinistveni identifikator računa.
     *
     * @var string|null
     * @ORM\Column(name="jir_code", type="string", nullable=true)
     */
    protected $JIRCode;

    public function __construct()
    {
        $this->articleCalculations = new ArrayCollection();
    }

    public function setOperatorLabel(string $label)
    {
        $this->operatorLabel = $label;
    }

    public function setOperatorName(string $name)
    {
        $this->operatorName = $name;
    }

    public function setOperatorOib(string $oib)
    {
        $this->operatorOIB = $oib;
    }

    public function setPaymentType(PaymentType $type)
    {
        $this->paymentType = $type->name();
    }

    public function setNumber(InvoiceNumber $number)
    {
        $this->number = $number;
    }

    public function getOperatorName(): string
    {
        return $this->operatorName;
    }

    public function getPaymentType(): PaymentType
    {
        return (new PaymentType($this->paymentType));
    }

    public function getNumber(): InvoiceNumber
    {
        return $this->number;
    }
}