<?php
namespace Invoice\Domain\Model;

/**
 * Obveznici fizkalizacije:
 * + fizičke osobe obveznici poreza na dohodak po osnovi samostalne djelatnosti prema odredbama Zakona o porezu na dohodak (obveznici vođenja poslovnih knjiga i „paušalisti“)
   + pravna i fizička osoba koja se smatra obveznikom poreza na dobit prema Zakonu o porezu na dobit za sve djelatnosti za koje je, prema odredbama posebnih propisa, obveznik izdavanja računa za isporuku dobra ili obavljene usluge.
   + Prema tome, novost je da su obveznici fiskalizacije (izdavanja fiskaliziranih računa) i samostalne djelatnosti, obveznici poreza na dohodak, kojima se ostvareni dohodak paušalno oporezuje.
   - iznajmljivači soba i postelja putnicima i turistima te organizatori kampova kojima se tako ostvareni dohodak paušalno oporezuje, nisu obveznici fiskalizacije jer ne obavljaju samostalnu djelatnost u smislu odredbi Zakona o porezu na dohodak  već ostvaruju dohodak od imovine.

   Ovo je moje: Moze se desiti da osoba nije obaveznik poreza PDV-a (plača ga paušalno), a mora fizkalizirati račun
 */

class FiscalInvoice extends Invoice
{
    /**
     * Broj računa.
     *
     * @var Number
     * @ORM\OneToOne(targetEntity="InvoiceNumber", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $number;

    /**
     * Oznaka operatera
     *
     * @var string
     * @ORM\Column(type="string", length=20)
     */
    private $operatorLabel;

    /**
     * Ime i prezime operatera
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $operatorName;

    /**
     * OIB operatera
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $operatorOIB;

    /**
     * Tip placanja (gotovina, transakcijski račun)
     *
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $paymentType;

    /**
     * Zaštitni kod izdavatelja računa.
     *
     * @var string|null
     * @ORM\Column(name="zki_code", type="string", nullable=true)
     */
    private $ZKICode;

    /**
     * Jedinistveni identifikator računa.
     *
     * @var string|null
     * @ORM\Column(name="jir_code", type="string", nullable=true)
     */
    private $JIRCode;
}