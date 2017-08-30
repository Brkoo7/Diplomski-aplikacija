<?php
namespace IssueInvoices\Domain\Model\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use IssueInvoices\Domain\Model\Administration\Administration;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="IssueInvoices\Infrastructure\Doctrine2\UserRepositoryImpl")
 */
class User implements UserInterface, \Serializable
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
    
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="IssueInvoices\Domain\Model\Administration\Administration", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $administration;

    public function setAdministration(Administration $administration)
    {
        $administration->setUser($this);
        $this->administration = $administration;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function getId()
    {
        return $this->id;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function getAdministration()
    {
        return $this->administration;
    }
}