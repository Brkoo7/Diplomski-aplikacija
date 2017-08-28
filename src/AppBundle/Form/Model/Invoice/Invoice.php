**
     * Prodavatelj.
     *
     * @var Seller
     * @ORM\OneToOne(targetEntity="Seller", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $seller;

    /**
     * Kupac.
     *
     * @var Buyer
     * @ORM\OneToOne(targetEntity="Buyer", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $buyer;

    /**
     * Vrsta računa.
     *
     * @var InvoiceType
     * @ORM\Column(name="invoice_type", type="string", nullable=true)
     */
    protected $invoiceType;

    /**
     * Napomene.
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    protected $notes;