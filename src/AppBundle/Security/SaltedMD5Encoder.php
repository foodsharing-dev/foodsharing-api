<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Intl\Exception\NotImplementedException;

class SaltedMD5Encoder extends BasePasswordEncoder
{
    public function encodePassword($raw, $salt)
    {
        throw new NotImplementedException;
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        if ($this->isPasswordTooLong($raw)) {
            return false;
        }
        $check = md5($salt.'-lz%&lk4-'.$raw);
        return $this->comparePasswords($check, $encoded);
    }

}
