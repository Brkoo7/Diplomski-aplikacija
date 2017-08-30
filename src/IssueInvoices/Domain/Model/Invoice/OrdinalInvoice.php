<?php

namespace IssueInvoices\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;

/**
 * Obični račun za one koji nisu obveznici fizkalizacije
 * 
 * @ORM\Entity
 */
class OrdinalInvoice extends BaseInvoice
{

}