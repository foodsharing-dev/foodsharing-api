<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ExclusionPolicy("all")
 * @ORM\Entity
 * @ORM\Table(name="fs_foodsaver")
 */
class Foodsaver implements AdvancedUserInterface
{
    /**
     * @Groups({"own_user", "profile"})
     * @Expose
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verified;

    /**
     * @ORM\Column(type="integer", name="rolle")
     */
    private $role;

    /**
     * @Groups({"own_user", "profile"})
     * @Expose
     * @ORM\Column(type="string", length=50)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $passwd;

    /**
     * @Groups({"own_user", "profile"})
     * @Expose
     * @ORM\Column(type="string", length=120, name="`name`")
     */
    private $firstName;

    /**
     * @Groups({"own_user"})
     * @Expose
     * @ORM\Column(type="string", length=120, name="nachname")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=30, name="telefon")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50, name="handy")
     */
    private $mobile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastLogin;

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set verified
     *
     * @param boolean $verified
     *
     * @return Foodsaver
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set role
     *
     * @param integer $role
     *
     * @return Foodsaver
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /** Get roles
     *
     * @return string[]
     */
    public function getRoles()
    {
        $roles = ['ROLE_FOODSHARER', 'ROLE_FOODSAVER', 'ROLE_STORE_COORDINATOR', 'ROLE_AMBASSADOR', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'];
        return array('ROLE_USER', $roles[$this->role]);
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Foodsaver
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Foodsaver
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set passwd
     *
     * @param string $passwd
     *
     * @return Foodsaver
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get passwd
     *
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    public function getPassword()
    {
        return $this->passwd;
    }

    /**
     * Get salt that is used by foodsharing code since 2015
     */
    public function getSalt()
    {
        return strtolower($this->email);
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {

    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Foodsaver
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Foodsaver
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Foodsaver
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return Foodsaver
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Foodsaver
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return Foodsaver
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}
