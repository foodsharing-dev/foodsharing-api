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
class User implements AdvancedUserInterface
{
    const ROLE_FOODSHARER = 0;
    const ROLE_FOODSAVER = 1;
    const ROLE_STORE_COORDINATOR = 2;
    const ROLE_AMBASSADOR = 3;
    const ROLE_ADMIN = 4;
    const ROLE_SUPER_ADMIN = 5;
    /**
     * @Groups({"ownUser", "profile", "userId"})
     * @Expose
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $verified = false;
    /**
     * @ORM\Column(type="integer", name="rolle")
     */
    private $role = 0;

    /**
     * @Groups({"ownUser", "profile"})
     * @Expose
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $photo = '';

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="passwd", length=32)
     */
    private $password;

    /**
     * @Groups({"ownUser", "profile"})
     * @Expose
     * @ORM\Column(type="string", length=120, name="`name`")
     */
    private $firstName = '';

    /**
     * @Groups({"ownUser"})
     * @Expose
     * @ORM\Column(type="string", length=120, name="nachname")
     */
    private $lastName = '';

    /**
     * @Expose
     * @Groups({"userProfileStore"})
     * @ORM\Column(type="string", length=30, name="telefon")
     */
    private $phone = '';

    /**
     * @Expose
     * @Groups({"userProfileStore"})
     * @ORM\Column(type="string", length=50, name="handy")
     */
    private $mobile = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set verified
     *
     * @param bool $verified
     *
     * @return User
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return bool
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set role
     *
     * @param int $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /** Get roles
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
     * @return User
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
     * @return User
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

    public function getPassword()
    {
        return $this->password;
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @param bool $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
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
     * @return User
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

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
