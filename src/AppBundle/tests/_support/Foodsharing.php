<?php
namespace AppBundle;

class Foodsharing {
    public static function pw_hash($email, $pw)
    {
        return md5($email.'-lz%&lk4-'.$pw);
    }
}
