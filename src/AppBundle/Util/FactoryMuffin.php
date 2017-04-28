<?php

namespace AppBundle\Util;

use League\FactoryMuffin\FactoryMuffin as fm;
use League\FactoryMuffin\Stores\RepositoryStore;

class FactoryMuffin
{
    public static $fm = null;

    public function __construct($manager)
    {
        self::init();
    }

    public static function init($manager)
    {
        self::$fm = new fm(new RepositoryStore($manager));
        self::$fm->loadFactories(__DIR__.'/../Factory');
    }

    public static function create($entity, $params = [])
    {
        return self::$fm->create($entity, $params);
    }

    public static function instance($entity, $params = [])
    {
        return self::$fm->instance($entity, $params);
    }

    public static function seed($count, $entity, $params = [])
    {
        return self::$fm->seed($count, $entity, $params);
    }
}
