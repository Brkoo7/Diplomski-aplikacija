<?php
namespace User\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Administration\Domain\Administration;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="Administration")
     */
    private $administration;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="user")
     */
    private $invoices;

    public function __cosstruct()
    {
        $this->invoices = new ArrayCollection();
    }

     /**
     * Set password
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles()
    {
        if ('ivan@gmail.com' === $this->email)
            return ['ROLE_ADMIN'];

        return ['ROLE_USER'];
    }
}