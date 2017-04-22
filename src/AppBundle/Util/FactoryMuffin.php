<?php
namespace AppBundle\Util;

use League\FactoryMuffin\FactoryMuffin as fm;

class FactoryMuffin {
    public static $fm = null;

    function __construct()
    {
        self::$fm = new fm();
        self::$fm->loadFactories(__DIR__.'/../Factory');
    }

    public static function create($entity, $params = [])
    {
        return self::$fm->instance($entity, $params);
    }
}
